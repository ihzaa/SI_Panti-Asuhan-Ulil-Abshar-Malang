$("#form_cari").on("submit", function () {
    event.preventDefault();
    let url = $(this).attr("action");
    url = url.replace('_|_cari_|_', $("#text_cari").val());
    window.location.href = encodeURI(url);
    // console.log(encodeURI(url+cari));
});
