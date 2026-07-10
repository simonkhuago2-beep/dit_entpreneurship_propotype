window.onload = function() {
    document.getElementById("download")
    .addEventListener("click",()=>{
        const voucher = this.document.getElementById("voucher");
        console.log(voucher);
        console.log(window);
        html2pdf().from(voucher).save();
    })
}