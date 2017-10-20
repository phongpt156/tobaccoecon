$(document).ready(function () {
    let hash;
    let page;
    let topic;
    let search;
    let isLoading = false;
    setDisplayPreload(true);

    setSearchInputValue();
    let resultTmp;
    let resultPaginateTmp;
    let itemPerPage = 10;

    let en_month = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    $('input[type="checkbox"').on('click', function (e) {
        if (isLoading) {
            e.preventDefault();
        } else {
            filter(e);
        }
    });
    
    $('.reset').on('click', function () {
        setTimeout(() => {
            choose();
        });
    });

    $('.custom-search-button').on('click', async function () {
        search = $('.custom-search-field').val();
        page = 1;
        await setHash();
        getData();
    });

    $(document).on('click', '.custom-post-term', function () {
        setTimeout(() => {
            choose();
        });
    });

    $(document).on('click', '.research-paginate-link', function () {
        page = $(this).attr('page');
        disablePaginateLink();
        setPageToHash(getHashString(), page);
        $('.research-paginate-link').removeClass('active');
        $(this).addClass('active');
        displayResult(getResultCurrentPage(resultTmp));
    });

    $(document).on('click', '#prev', function () {
        if (!$(this).hasClass('disabled')) {
            page--;        
            disablePaginateLink();
            setPageToHash(getHashString(), page);
            $('.research-paginate-link').removeClass('active');
            $('.research-paginate-link').eq(page - 1).addClass('active');
            displayResult(getResultCurrentPage(resultTmp));
        }
    });

    $(document).on('click', '#next', function () {
        if (!$(this).hasClass('disabled')) {
            page++;
            disablePaginateLink();
            setPageToHash(getHashString(), page);
            $('.research-paginate-link').removeClass('active');
            $('.research-paginate-link').eq(page - 1).addClass('active');
            displayResult(getResultCurrentPage(resultTmp));
        }
    });

    loadPage();

    async function filter(e) {
        page = 1;

        await setTopicsToHash(e.target.value);
        getData();
    }

    async function choose() {
        page = 1;
        await setCheckboxValue();
        getData();
    }

    function setHash() {
        return new Promise((resolve, reject) => {
            if (!page) {
                page = 1;
            }

            let newHash = '';
            if (topic) {
                newHash += topic;
            }
            if (search) {
                if (topic) {
                    newHash += ',s=' + search;
                } else {
                    newHash += 's=' + search;
                }
            }

            if (newHash) {
                newHash += ',p=' + page;
            } else {
                newHash += 'p=' + page;
            }
            location.hash = newHash;

            resolve();
        });
    }

    async function loadPage() {
        hash = getHashString();
        page = getPageStringFromHash(hash);
        if (!page) {
            setPageToHash(hash, 1);
            hash = getHashString();
        }

        topic = getTopicsStringFromHash(hash);
        search = getSearchStringFromHash(hash);
        let data = await setHash();
        setCheckboxValue();
        getData(data);
    }

    function getData() {
        if (!isLoading) {
            isLoading = true;
            setDisplayPreload(true);
            let formData = new FormData();
            formData.append('topics', topic);
            formData.append('search', search);
            fetch('http://localhost/tobacco/wp-json/wp/v2/research_en', {
                method: 'post',
                header: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
                },
                body:  formData
            })
            .then(response => response.json())
            .then(result => {
                resultTmp = result.data;
                let sumPaginateLink = getSumPaginateLink(resultTmp);
                let html = getPaginateLinkListHtml(sumPaginateLink);
                displayPaginateLinkList(html);
                disablePaginateLink();
                displayResult(getResultCurrentPage(resultTmp));
                isLoading = false;
                setDisplayPreload(false);
            });
        }
    }

    function getHashString() {
        return location.hash.slice(1);
    }

    function setCheckboxValue() {
        return new Promise((resolve, reject) => {
            topic = getTopicsStringFromHash(getHashString()).split(',');
            let checkbox = $('input[type="checkbox"]');
            for (let i = 0; i < checkbox.length; i++) {
                if (topic.indexOf(checkbox[i].value) !== -1) {
                    checkbox[i].checked = true;
                } else {
                    checkbox[i].checked = false;
                }
            }
            resolve();
        });
    }

    function setDisplayPreload(isLoading) {
        if (isLoading) {
            $('.pre-load').addClass('d-flex');
        } else {
            $('.pre-load').removeClass('d-flex');
        }
    }

    function getPageStringFromHash(hash) {
        let pos = hash.indexOf('p=');

        if (pos != -1) {
            return hash.slice(pos + 2);
        }

        return '';
    }

    function setPageToHash(hash, p) {
        let pos = hash.indexOf('p=');
        if (pos != -1) {
            location.hash = hash.slice(0, pos) + 'p=' + p;
        } else {
            location.hash = hash.slice(0) + ',p=' + p;
        }
    }

    function setTopicsToHash(id) {
        return new Promise((resolve, reject) => {
            topic = getTopicsStringFromHash(getHashString()).split(',');
            if (topic.length && topic[0] !== '') {
                let pos = topic.indexOf(id);
                if (pos !== -1) {
                    topic.splice(pos, 1);
                } else {
                    topic.push(id);
                }
            } else {
                topic[0] = id;
            }
            topic = topic.join(',');
            setHash();
            resolve();
        });
    }

    function getTopicsStringFromHash(hash) {
        let last = hash.indexOf('s');
        if (last == -1) {
            last = hash.indexOf('p');
        }
        
        if (last != -1 && last != 0) {
            let string = hash.slice(last - 1, last);
            if (string === ',') {
                return hash.slice(0, last - 1);    
            }
            return hash.slice(0, last);
        }
        return '';
    }

    function getSearchStringFromHash(hash) {
        let pos = hash.indexOf('s');
        if (pos != -1) {
            hash = hash.slice(pos);
            pos = hash.indexOf(',');
            return hash.slice(2, pos);
        }
        return '';
    }

    function setActiveClassPaginateLink(pos) {
        $('.research-paginate-link').removeClass('active');
        $('.research-paginate-link')[pos - 1].addClass('active');
    }
    
    function getSumPaginateLink(result) {
        let length = result.length;

        return Math.floor(length % itemPerPage === 0 ? length / itemPerPage : length / itemPerPage + 1);
    }

    function getPaginateLinkListHtml(sumPaginateLink) {
        if (page > sumPaginateLink) {
            return '';
        }

        let clss;
        let html = '';
        let paginateHtml = '';

        for (let i = 1; i <= sumPaginateLink; i++) {
            clss = i == page ? 'active' : '';
            
            paginateHtml += `
                <li class="page-item ${clss} research-paginate-link" page="${i}"><a class="page-link">${i}</a></li>
            `;
        }

        html += `
            <div class="d-flex justify-content-end">
                <ul class="pagination p-0">
                    <li class="page-item" id="prev">
                        <a class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    ${paginateHtml}
                    <li class="page-item" id="next">
                        <a class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        `;

        return html;
    }

    function displayPaginateLinkList(html) {
        $('.paginate-wrapper').html(html);
    }

    function getResultCurrentPage(result) {
        let sumPaginateLink = getSumPaginateLink(result);
        let start = (page - 1) * itemPerPage;
        let end = start + itemPerPage;
        
        if (page <= sumPaginateLink) {
            return result.slice(start, end);
        }

        return [];
    }
    
    function disablePaginateLink() {
        if (page == 1) {
            $('#prev').addClass('disabled');
        } else {
            $('#prev').removeClass('disabled');
        }

        if (page == getSumPaginateLink(resultTmp)) {
            $('#next').addClass('disabled');
        } else {
            $('#next').removeClass('disabled');
        }
    }

    function displayResult(result) {
        let html = '';
        let terms;
        let date;
        let length;
        length = result.length;

        if (length) {
            html += '<div class="search-result-list">';

            result.forEach(val => {
                terms = '';
                length = val.terms.length;
                val.terms.forEach((term, index) => {
                    if (index != length - 1) {
                        terms += `
                            <a href="/tobacco/nghien-cuu/#${term.term_id},p=1" class="custom-post-term">${term.name}</a> / 
                        `
                    } else {
                        terms += `
                            <a href="/tobacco/nghien-cuu/#${term.term_id},p=1" class="custom-post-term">${term.name}</a>
                        `
                    }
                });
                date = new Date(val.post_date);
                date = `${en_month[date.getMonth()]} ${date.getFullYear()}`;
                html += `
                    <div class="pt-3">
                        <div class="d-flex post-wrapper pt-3">
                            <div class="col-md-8">
                                <h4>
                                    <a href="${val.guid}">${val.post_title}</a>
                                </h4>
                                <p><span class="custom-post-excerpt">${val.post_excerpt}</span><a class="more" href="${val.guid}"> Read more &raquo;</a>
                            </div>
                            <div class="col-md-4">
                                <div class="date">
                                    ${date}
                                </div>
                                <p class="topic-list"><strong>Topics</strong>: ${terms}
                            </div>
                        </div>
                    </div>
                `
            });
            html += '</div>';
        } else {
            html += `
                <p class="no-result my-5 text-center" style="font-size: 2rem; color: #6b635a; border-top: 1px solid #c6c1bb">No research found.</p>
            `;
        }
        $('.search-result-wrapper').html(html);
    }

    function setSearchInputValue() {
        if (search) {
            $('.custom-search-field').val(search);
        }
    }
});
