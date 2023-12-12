const navItems =document.querySelector('.nav__items');
const openNavBtn= document.querySelector('#open__nav-btn');
const closeNavbtn=document.querySelector('#close__nav-btn');

//open nav dropdown
const openNav = ()=> {
    navItems.style.display='flex';
    openNavBtn.style.display='none';
    closeNavbtn.style.display='inline-block';
}

const closeNav = ()=> {
    navItems.style.display='none';
    openNavBtn.style.display='inline-block';
    closeNavbtn.style.display='none';
}
openNavBtn.addEventListener('click',openNav);
closeNavbtn.addEventListener('click',closeNav);


const sidebar=document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show__sidebar-btn');
const hideSidebarBtn =document.querySelector('#hide__sidebar-btn');

//shows sidebar on small devices

const showSidebar = () =>{
    sidebar.style.left='0';
    showSidebarBtn.style.display='none';
    hideSidebarBtn.style.display='inline-block';

}
//hides sidebar on small devices

const hideSidebar = () => {
    sidebar.style.left='-100%';
    showSidebarBtn.style.display='inline-block';
    hideSidebarBtn.style.display='none';

}

showSidebarBtn.addEventListener('click',showSidebar);
hideSidebarBtn.addEventListener('click',hideSidebar);
