const cautraloi = document.querySelectorAll('.cautraloi');
const submitBtn =document.getElementById('submit');
const quiz =document.getElementById('question');
let cauhoi_hientai = 0;
let socaudung = 0;
let diem = 0;

load_cauhoi()

function load_cauhoi(){
    submitBtn.disabled = true;
    remove_answer()

    const cauhoi = document.getElementById('title');
    const a_cautraloi = document.getElementById('a_cautraloi');
    const b_cautraloi = document.getElementById('b_cautraloi');
    const c_cautraloi = document.getElementById('c_cautraloi');
    const d_cautraloi = document.getElementById('d_cautraloi');

    fetch('http://localhost:8080/restful_PHP_API/apiController/question/read.php')
    .then(res => res.json())
    .then(data => {
        document.getElementById('tongsocauhoi').value = data.data.length;
        //console.log(data);
        const get_cauhoi = data.data[cauhoi_hientai];
        console.log(get_cauhoi);
        
        cauhoi.innerText = get_cauhoi.title;
        a_cautraloi.innerText = get_cauhoi.cau_a;
        b_cautraloi.innerText = get_cauhoi.cau_b;
        c_cautraloi.innerText = get_cauhoi.cau_c;
        if(get_cauhoi.cau_d!=null){
            document.getElementById('cau_d').classList.remove('hienthicautraloi');
            d_cautraloi.innerText = get_cauhoi.cau_d;
        }
        else{
            document.getElementById('cau_d').classList.add('hienthicautraloi');
        }
        document.getElementById('caudung').value = get_cauhoi.ketqua;
        })
        .catch(error => console.log(error));
}

//chon cau tra loi
function get_answer(){
    let answer = undefined;
    cautraloi.forEach((cautraloi) => {
        if(cautraloi.checked){
            answer = cautraloi.id;
        }
    })
    return answer;
}

//remove cau tra loi
function remove_answer(){
    cautraloi.forEach((cautraloi) => {
        cautraloi.checked = false;
    })
}

cautraloi.forEach((elem) => {
    elem.addEventListener("change", function(event){
        submitBtn.removeAttribute("disabled");
    });
});
//su kien click submit
submitBtn.addEventListener("click", () =>{
    const answer = get_answer();
    console.log(answer);

    if(answer){
        if(answer === document.getElementById('caudung').value){
            socaudung++;
            diem++;
            console.log(socaudung);
        }
    }

    cauhoi_hientai++;
    load_cauhoi();

    if(cauhoi_hientai<document.getElementById('tongsocauhoi').value){
        load_cauhoi();
    }else{
        const tongsocauhoi = document.getElementById('tongsocauhoi').value;
        quiz.innerHTML = `
        <h2> Ban da dung ${socaudung}/${tongsocauhoi} cau hoi. <h2>
        <p style="font-size:15px"> So diem dat duoc ${diem} </p>
        <button class = "btn-btn-warning" onclick ="location.reload()"> Lam lai </button>
        `
    }

})