
const queryString = window.location;
const urlParams = new URL(queryString);
const pageParam = urlParams.searchParams.get('page')
// list of nav links
const nav_a_link_list = document.querySelectorAll(".nav-link")
// check url parameters and apply css to selected nav
nav_a_link_list.forEach((link) => {
  const linkParams = link.getAttribute("href")
  const page = (linkParams.split('page=')[1]||'').split('&')[0]
  if(page == pageParam){
      link.classList.add("active")
  }else{
      link.classList.remove("active")
  }
});
