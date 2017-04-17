$(document).ready(function () {

    var tags = new Bloodhound({
        prefetch: '/tags.json',
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,

    });

    $('.tag-input').tagsinput({
        typeaheadjs: {
            name: 'tags',
            display: 'name',
            value: 'name',
            source: tags
        }
    });
})