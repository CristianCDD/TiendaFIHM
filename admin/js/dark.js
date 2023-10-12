const btnswitch = document.getElementById('switch');

btnswitch.addEventListener('click',()=>{
    document.body.classList.toggle('dark-mode');
    btnswitch.classList.toggle('active');
})