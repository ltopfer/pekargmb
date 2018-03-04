function FiltrujKontakty(input)
{
    var hledat = $(input).val().toLowerCase();
    
    $(".tabklasik > tr, .tabklasik > tbody > tr").each(function() {
        $(this).wrap("<hidden>");
    });

    $("tr > th").parents("tr").unwrap("hidden");

    $(".prijmeni").each(function() {
        if($(this).text().toLowerCase().indexOf(hledat) >= 0)
            $(this).parents("tr").unwrap("hidden");
    });
    
    $(".jmeno").each(function() {
        if($(this).text().toLowerCase().indexOf(hledat) >= 0)
            $(this).parents("tr").unwrap("hidden");
    });
    
    $(".titul").each(function() {
        if($(this).text().toLowerCase().indexOf(hledat) >= 0)
            $(this).parents("tr").unwrap("hidden");
    });    
}