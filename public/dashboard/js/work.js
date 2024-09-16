$(function() {
    CKEDITOR.replace("ar[description]", {
        filebrowserBrowseUrl: imageGalleryBrowseUrl,
        filebrowserUploadUrl:
            imageGalleryUploadUrl +
            "?_token=" +
            $("meta[name=csrf-token]").attr("content"),
        removeButtons: "About"
    });

    CKEDITOR.replace("en[description]", {
        filebrowserBrowseUrl: imageGalleryBrowseUrl,
        filebrowserUploadUrl:
            imageGalleryUploadUrl +
            "?_token=" +
            $("meta[name=csrf-token]").attr("content"),
        removeButtons: "About"
    });
});
