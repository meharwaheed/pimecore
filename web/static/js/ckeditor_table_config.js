CKEDITOR.editorConfig = function( config ) {
    config.uiColor = '#5eab5d';
    config.toolbar = [
        { name: 'document', items: [ 'Source'] },
        { name: 'paragraph', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight'] },
        { name: 'insert', items: [ 'Table'] }
    ];
};