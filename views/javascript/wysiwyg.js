var editorElements = document.querySelectorAll("textarea.editor");

Array.from(editorElements).forEach(function(editorElement) {
    ClassicEditor
        .create(editorElement)
        .catch(function(error) {
            console.error(error);
        });
});