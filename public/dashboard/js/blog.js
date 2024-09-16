$(function() {
    CKEDITOR.replace("ar[description]", {
        filebrowserBrowseUrl: imageGalleryBrowseUrl,
        filebrowserUploadUrl:
            imageGalleryUploadUrl +
            "?_token=" +
            $("meta[name=csrf-token]").attr("content"),
        removeButtons: "About",
        contentsLangDirection: 'rtl'
    });

    CKEDITOR.replace("ar[introduction]", {
        removeButtons: "About",
        contentsLangDirection: 'rtl'
    });


    CKEDITOR.replace("ar[content_table]", {
        removeButtons: "About",
        contentsLangDirection: 'rtl'
    });

    CKEDITOR.replace("ar[first_paragraph]", {
        removeButtons: "About",
        contentsLangDirection: 'rtl'
    });

});
