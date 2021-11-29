<?php

/**
 * Provide a public-facing tabs view for the plugin
 */
?>

<?php ob_start() ?>

<div class="nm-tabs <?php echo $tab_group_slug; ?>">
    <ul class="nm-tabs-list <?php echo $tab_group_slug; ?>">
        <?php foreach ($tabs as $tab): ?>
        <li class="nm-tab <?php echo $tab_group_slug; ?>" data-group="<?php echo $tab_group_slug; ?>" data-id="<?php echo $tab['id']; ?>">
            <?php if (array_key_exists('icon', $tab)): ?>
            <div class="nm-tab-icon">
                <div class="nm-tab-icon-regular <?php echo array_key_exists('active_icon', $tab) ? "" : "no-active-icon"; ?>" style="background-image:url(<?php echo $tab['icon']; ?>)"></div>
                <?php if (array_key_exists('active_icon', $tab)): ?>
                    <div class="nm-tab-icon-active" style="background-image:url(<?php echo $tab['active_icon'];?>)"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <h2 class="nm-tab-title"><?php echo $tab['title']; ?></h2>
        </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php return ob_get_clean(); ?>