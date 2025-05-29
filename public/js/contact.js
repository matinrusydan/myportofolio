$("#contactForm").submit(function(e) {
    e.preventDefault();

    var name = $("#name").val().trim();
    var email = $("#email").val().trim();
    var phone = $("#phone").val().trim();
    var message = $("#message").val().trim();
    var error = "";

    if (name === "" || email === "" || phone === "" || message === "") {
        error = "Semua field wajib diisi.";
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        error = "Format email tidak valid.";
    } else if (!/^\d{10,15}$/.test(phone)) {
        error = "Nomor HP harus berupa angka dan 10-15 digit.";
    }

    if (error !== "") {
        $("#formMessage").text(error).css("color", "red");
    } else {
        $("#formMessage").css("color", "green").text("Form berhasil dikirim!");
        $(this).trigger("reset");
    }
});
