<?php
/**
 * Provide a public-facing content view for the plugin
 */
?>

<?php ob_start() ?>

<div class="nm-tabs-contents <?php echo $tab_group_slug; ?>">
  <?php foreach ($tabs as $tab): ?>
    <div class="nm-tab-content <?php echo $tab_group_slug; ?>" data-id="<?php echo $tab['id']; ?>">
      <?php echo apply_filters('the_content', $tab['content']); ?>
    </div>
  <?php endforeach; ?>
</div>

<?php return ob_get_clean(); ?>