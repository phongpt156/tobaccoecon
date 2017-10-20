<div class="container research-wrapper pt-4">
<form class="row">
  <div class="col-lg-3">
    <h1 class="m-0 mb-1">Tìm nghiên cứu</h1>
  </div>
  <div class="col-lg-5 col-sm-6 col-9">
    <input class="custom-search-field" type="text" placeholder="Tìm kiếm" />
  </div>
  <div class="col-3 col-md-2 col-lg-1">
    <button class="custom-search-button py-0 px-3">Tìm</button>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-3 text-sm-right"><a class="reset" href="#p=1">Reset Search</a></div>
</form>
<div class="row pt-4">
  <div class="col-12">
    <h4>Chủ đề</h4>
  </div>
  <div class="row col-12 filter">
  [insert_php]
    echo '<script src="' . get_template_directory_uri() . '/assets/js/research.js" type="text/javascript"></script>';
    $taxonomy = 'topic';
$terms = get_terms($taxonomy, ['orderby' => 'count desc', 'hide_empty' => false]);
$hierarchy = _get_term_hierarchy($taxonomy);
foreach($terms as $term) {
  if($term->parent) {
      continue;
  }
  $html .= '<ul class="col-md-4 col-sm-6"><li><label>';
  $html .= '<input type="checkbox" value="' . $term->term_id . '" />';
  $html .= $term->name;
  $html .= '</label></li>';
  if ($hierarchy[$term->term_id]) {
      $html .= '<li><ul>';
      foreach($hierarchy[$term->term_id] as $child) {
          $child = get_term($child, $taxonomy);
          $html .= '<li><label>';
          $html .= '<input type="checkbox" value="' . $child->term_id . '" />';
          $html .= $child->name;
          $html .= '</label></li>';
      }
      $html .= '</ul></li></ul>';
  }
  $html .= '</ul>';
}
echo $html;
  [/insert_php]
  </div>
</div>
<div class="pre-load-wrapper">
  <div class="pre-load align-items-center">Loading ...</div>
</div>
<div class="paginate-wrapper">
</div>
<div class="search-result-wrapper">
</div>
</div>