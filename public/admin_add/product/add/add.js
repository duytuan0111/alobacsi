jQuery(document).ready(function ($) {
    $('.tag_selects_choose').select2({
      tags: true,
      tokenSeparators: [',']
    });
    $('.category_id').select2();
    // var editor = new FroalaEditor('.editor')
  });