$(document).ready(function () {
    function performEvennementSearch() {
        var value = $("#searchEvennementForm input[name='q']").val();
        var searchUrl = $("#searchEvennementForm").data('search-url');
        var evennementsTable = $("#evennementsTable");

        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: {'q': value},
            success: function (html) {
                // Update the content of the evennements table with the search results HTML
                evennementsTable.html(html);
            },
        });
    }
    $("#searchEvennementForm input[name='q']").on('input', function () {
        performEvennementSearch();
    });
    // Bind the search function to the form submission
    $("#searchEvennementForm").submit(function (event) {
        event.preventDefault();
        performEvennementSearch();
    });
});