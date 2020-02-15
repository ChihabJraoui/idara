$(document).ready(function()
{
    /*
     * Member Search
     */
    $('#formMemberSearch').submit(function(e)
    {
        var word = $('#text-member-search').val();

        $.ajax({
            type: 'POST',
            url: 'member/search',
            data: {
                ajax: true,
                word: word
            },
            success: function(result)
            {
                $('#memberSearchResult').html(result);
            }
        });

        e.preventDefault();
    });
});