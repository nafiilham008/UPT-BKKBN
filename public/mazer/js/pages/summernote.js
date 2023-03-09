$("#summernote").summernote({
    tabsize: 2,
    height: 500,
    maximumImageFileSize: 204800,
    // maximumFileSize: 1048576
    toolbar: [
        [
            "style",
            ["bold", "italic", "underline", "clear", "fontname", "fontsize"],
        ],
        ["font", ["strikethrough", "superscript", "subscript"]],
        ["color", ["color"]],
        ["para", ["ul", "ol", "paragraph"]],
        ["add", ["height", "table"]],

        ["misc", ["picture", "link"]],
        ["help", ["help"]],
    ],
    fontNames: ["Arial", "Arial Black", "Comic Sans MS", "Courier New",'sans-serif', "Roboto",],
    fontSizes: ["8", "9", "10", "11", "12", "14", "16", "18", "20", "22", "24", "36"],
    // callbacks: {
    //     onMediaDelete : function(target) {
    //         var mpath = $(target[0]).attr('src').replace("..", "");
    //         $('#summernote').val(mpath);
    //         },
    // },
});
$("#hint").summernote({
    height: 100,
    toolbar: false,
    placeholder: "type with apple, orange, watermelon and lemon",
    hint: {
        words: ["apple", "orange", "watermelon", "lemon"],
        match: /\b(\w{1,})$/,
        search: function (keyword, callback) {
            callback(
                $.grep(this.words, function (item) {
                    return item.indexOf(keyword) === 0;
                })
            );
        },
    },
});
