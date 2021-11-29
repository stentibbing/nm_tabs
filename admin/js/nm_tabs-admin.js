(function ($) {
  "use strict";

  $(function () {
    jQuery(function ($) {
      // Set all variables to be used in scope
      const metaBox = $("#nm_tabs_icons.postbox");
      let frame;

      // ADD IMAGE LINK
      $(".nm-tabs-add-icon", metaBox).on("click", function (event) {
        event.preventDefault();

        // Set data-role from parent to target the right dom elements below
        let role = $(this).parents(".nm-tabs-icon-selection").data("role");

        // If the media frame for the role already exists, reopen it.
        if (frame && frame.role == role) {
          frame.open();
          return;
        }

        // Create a new media frame
        frame = wp.media({
          title: "Select or Upload Media Of Your Chosen Persuasion",
          button: {
            text: "Use this media",
          },
          multiple: false,
        });

        frame.role = role;

        // When an image is selected in the media frame...
        frame.on("select", function () {
          // Get media attachment details from the frame state
          var attachment = frame.state().get("selection").first().toJSON();

          // Send the attachment URL to our custom image input field.
          $(
            ".nm-tabs-icon-thumbnail",
            ".nm-tabs-icon-selection[data-role='" + role + "']"
          )
            .css("background-image", "url(" + attachment.url + ")")
            .removeClass("non-populated");

          // Send the attachment id to our hidden input
          $(
            ".nm-tabs-icon-id",
            ".nm-tabs-icon-selection[data-role='" + role + "']"
          ).val(attachment.id);

          // Hide the add image link
          $(
            ".nm-tabs-add-icon",
            ".nm-tabs-icon-selection[data-role='" + role + "']"
          ).addClass("hidden");

          // Unhide the remove image link
          $(
            ".nm-tabs-delete-icon",
            ".nm-tabs-icon-selection[data-role='" + role + "']"
          ).removeClass("hidden");
        });

        // Finally, open the modal on click
        frame.open();
      });

      // DELETE IMAGE LINK
      $(".nm-tabs-delete-icon", metaBox).on("click", function (event) {
        event.preventDefault();

        // Set data-role from parent to target the right dom elements below
        let role = $(this).parents(".nm-tabs-icon-selection").data("role");

        // Clear out the preview image
        $(
          ".nm-tabs-icon-thumbnail",
          ".nm-tabs-icon-selection[data-role='" + role + "']"
        )
          .css("background-image", "")
          .addClass("non-populated");

        // Un-hide the add image link
        $(
          ".nm-tabs-add-icon",
          ".nm-tabs-icon-selection[data-role='" + role + "']"
        ).removeClass("hidden");

        // Hide the delete image link
        $(
          ".nm-tabs-delete-icon",
          ".nm-tabs-icon-selection[data-role='" + role + "']"
        ).addClass("hidden");

        // Delete the image id from the hidden input
        $(
          ".nm-tabs-icon-id",
          ".nm-tabs-icon-selection[data-role='" + role + "']"
        ).val("");
      });
    });
  });
})(jQuery);
