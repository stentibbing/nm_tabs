<div class="nm-tabs-icons-container">

  <div class="nm-tabs-icon-selection" data-role="regular">
    <div class="nm-tabs-icon-thumbnail <?php echo $icon_exists ? '' : 'non-populated' ?>"
      <?php if ($icon_exists): ?>  
      style="background-image: url(<?php echo $icon_src[0]; ?>);"
      <?php endif; ?>
    ></div>
    <div class="nm-tabs-icon-add-remove">
      <p class="hide-if-no-js">
        <a class="nm-tabs-add-icon <?php echo $icon_exists ? 'hidden' : ''; ?>" href="<?php echo $upload_link ?>">
          <?php _e('Set tab icon') ?>
        </a>
        <a class="nm-tabs-delete-icon <?php echo $icon_exists ? '' : 'hidden'; ?>" href="#">
          <?php _e('Remove tab icon') ?>
        </a>
      </p>
    </div>
    <input class="nm-tabs-icon-id" name="nm-tabs-icon" type="hidden" value="<?php if ($icon_exists) {
    echo esc_attr($icon);
}?>" />
  </div>
  
  <div class="nm-tabs-icon-selection" data-role="active">
    <div class="nm-tabs-icon-thumbnail <?php echo $active_icon_exists ? '' : 'non-populated' ?>"
      <?php if ($active_icon_exists): ?>  
      style="background-image: url(<?php echo $active_icon_src[0]; ?>);"
      <?php endif; ?>
    ></div>
    <div class="nm-tabs-icon-add-remove">
      <p class="hide-if-no-js">
        <a class="nm-tabs-add-icon <?php echo $active_icon_exists ? 'hidden' : ''; ?>" href="<?php echo $upload_link ?>">
          <?php _e('Set active tab icon') ?>
        </a>
        <a class="nm-tabs-delete-icon <?php echo $active_icon_exists ? '' : 'hidden'; ?>" href="#">
          <?php _e('Remove active tab icon') ?>
        </a>
      </p>
    </div>
    <input class="nm-tabs-icon-id" name="nm-tabs-active-icon" type="hidden" value="<?php if ($active_icon_exists) {
    echo esc_attr($active_icon);
}?>" />
  </div>

</div>

