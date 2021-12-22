<?php
/**
 * Provide a public-facing content view for the plugin
 */
?>

<?php ob_start() ?>

<div class="nm-tabs-contents <?php echo $tab_group_slug; ?>">
  <?php foreach ($tabs as $tab): ?>
    <div class="nm-tab-content-heading">
      <div class="nm-tab <?php echo $tab_group_slug; ?>" data-group="<?php echo $tab_group_slug; ?>" data-id="<?php echo $tab['id']; ?>">
        <?php if (array_key_exists('icon', $tab)): ?>
        <div class="nm-tab-icon">
            <div class="nm-tab-icon-regular <?php echo array_key_exists('active_icon', $tab) ? "" : "no-active-icon"; ?>" style="background-image:url(<?php echo $tab['icon']; ?>)"></div>
            <?php if (array_key_exists('active_icon', $tab)): ?>
                <div class="nm-tab-icon-active" style="background-image:url(<?php echo $tab['active_icon'];?>)"></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <h2 class="nm-tab-title"><?php echo $tab['title']; ?></h2>
      </div>
    </div>
    <div class="nm-tab-content <?php echo $tab_group_slug; ?>" data-id="<?php echo $tab['id']; ?>">
      <?php echo apply_filters('the_content', $tab['content']); ?>
    </div>
  <?php endforeach; ?>
</div>

<?php return ob_get_clean(); ?>