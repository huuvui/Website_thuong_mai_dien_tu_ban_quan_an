
    var giohang = new Array();

    function themvaogiohang(x) {
        var boxsp = x.parentElement.children;
        var hinh = boxsp[0].children[0].src;
        var gia = boxsp[1].children[0].innerText;
        var tensp = boxsp[2].innerText;
        var soluong = boxsp[3].value;
        var sp = new Array(hinh, gia, tensp, soluong);

        giohang.push(sp);

        console.log(giohang);
        showcountsp();

    }

    function showcountsp() {
        document.getElementById("countsp").innerHTML = giohang.length;
    }
