window.onload = function () {
    document.getElementById("download")
        .addEventListener("click", () => {
            const card = this.document.getElementById("dvContainer");
            console.log(card);
            console.log(window);
            var opt = {
                margin: 1,
                filename: 'mina-carte.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'landscape'}
            };
            hmtl2pdf().from(card).save();
        })
}