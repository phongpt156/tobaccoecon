<section class="container pt-4 topics-wrapper">
<div class="row">
  <div class="col-md-3 sidebar-nav">
    <p>Select topic</p>
    <ul class="nav nav-tabs" role="tablist">
    [insert_php]
      $topics = get_terms(['taxonomy' => 'topic', 'hide_empty' => false, 'parent' => 0]);
      $i = 0;
      foreach ($topics as $topic):
        $i++;
        if ($i === 1):
          echo '<li class="nav-item"><a class="active" data-toggle="tab" role="tab" href="#topic-' . $topic->term_id . '">' . $topic->name . '</a></li>';
        else:
          echo '<li class="nav-item"><a class="" data-toggle="tab" role="tab" href="#topic-' . $topic->term_id . '">' . $topic->name . '</a></li>';
        endif;
      endforeach;
    [/insert_php]
    </ul>
  </div>
  <div class="tab-content col-md-9 topic-detail-info">
    [insert_php]
      $i = 0;
      foreach ($topics as $topic):
        $i++;
        $html = '';
        if ($i === 1):
          $html .= '<div class="tab-pane fade show active" id="topic-' . $topic->term_id . '" role="tabpanel">';
        else:
          $html .= '<div class="tab-pane fade" id="topic-' . $topic->term_id . '" role="tabpanel">';
        endif;
        $html .= '<h2><a href="' . get_home_url() . '/nghien-cuu/#' . $topic->term_id . '">';
        $html .= $topic->name;
        $html .= '</a></h2>';
        $html .= '<p>';
        $html .= $topic->description;
        $html .= '</p>';
        $html .= '<p class="more"><a href="' . get_home_url() . '/nghien-cuu/#' . $topic->term_id . '">Các nghiên cứu liên quan <span>»</span>';
        $html .= '</a></p>';
        $html .= '<h3>Xem nghiên cứu bằng chủ đề phụ</h3>';
        $subTopicIds = get_term_children($topic->term_id, 'topic');
        $html .= '<ul>';
        foreach ($subTopicIds as $subTopicId) {
          $subTopic = get_term($subTopicId);
          $html .= '<li><div class="row">';
          $html .= '<div class="col-md-4"><h4>';
          $html .= '<a href="' . get_home_url() . '/nghien-cuu/#' . $subTopic->term_id . '">';
          $html .= $subTopic->name;
          $html .= '</a>';
          $html .= '</h4></div>';
          $html .= '<div class="col-md-8">';
          $html .= '<p>';
          $html .= $subTopic->description;
          $html .= '</p>';
          $html .= '<p class="more"><a href="' . get_home_url() . '/nghien-cuu/#' . $subTopic->term_id . '">Xem Nghiên cứu<span>»</span>';
          $html .= '</a></p>';
          $html .= '</div>';
          $html .= '</div></li>';
        }
        $html .= '</ul>';
        $html .= '</div>';
        echo $html;
      endforeach;
    [/insert_php]
    <div>
      <h2>
    </div>
  </div>
</div>
</section>