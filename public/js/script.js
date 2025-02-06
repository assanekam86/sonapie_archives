window.onload = () => {
	let boutons = document.querySelectorAll('.custom-control-input')

	for(let bouton of boutons){
	bouton.addEventListener("click",activer)
	}
}


function  activer(){
	let xmlhttp = new XMLHttpRequest;

	xmlhttp.open('GET','/users/activer/'+this.dataset.id)
	xmlhttp.send()
}


 var loop_count=1;

      var loop_image_count=1;
      function add_images_more(){
        loop_image_count++;
        var html='<input id="piid" name="piid[]" type="hidden" class="form-control" aria-required="true" aria-invalid="false"><div class="col-md-10 product_images_'+loop_image_count+'"><label for="images" class="control-label mb-1">Fichier '+loop_image_count+'</label><input id="imagess" name="fichier[]" type="file" class="form-control" aria-required="true" aria-invalid="false"></div>';
            html+='<div class="col-md-2"><label for="" class="control-label mb-1">ACTION</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_image_more("'+loop_image_count+'")><i class="fa fa-minus"></i>Remove</button></div>';
         jQuery('#product_images_box').append(html)   
      }

      function remove_image_more(loop_image_count){
        jQuery('.product_images_'+loop_image_count).remove();
      }

/*let tabs = document.querySelectorAll('.tab-link:not(.desactive)');
tabs.forEach(tab => {
	tab.addEventListener("click", () => {
		unSelectAll();
		tab.classList.add('active');
		let ref = tab.getAttribute('data-ref');
		document.querySelector('.tab-body[data-id="${ref}"]').classList.add('active');
	});
});*/

/*function unSelectAll(){
	tabs.forEach(tab => {
		tab.classList.remove('active');
	})

	let tabbodies = document.querySelectorAll('.tab-body');
	tabbodies.forEach(tab => {
		tab.classList.remove('active');
	})
}

document.querySelector('.tab-link.active').click();
*/


const tab_link = document.querySelectorAll('.tab-link'); 
const tab_links = document.querySelectorAll('.tab-link'); 
const tab_body = document.querySelectorAll('.tab-body');
//alert(tab_link.length)
let index = 0;
tab_body.forEach((el,i)=>{
	if(i!=0){
		el.style="display:none"
	}})
tab_link.forEach(tab_link => {
	tab_link.addEventListener('click', () => {
		//alert(tab_link)
		if(!tab_link.classList.contains('active')){
			tab_link.classList.add('active');

		}

		index = tab_link.getAttribute('data-anim');
		//alert(index);
/*console.log(tab_links.length)*/
		for(i=0; i < tab_links.length; i++){
			//console.log(tab_links[i].getAttribute('data-anim'))
			if(tab_links[i].getAttribute('data-anim') != index){
				tab_links[i].classList.remove('active');
			}
		}
//console.log(index)


		for (j = 0; j < tab_links.length; j++){
			console.log(tab_body[j].getAttribute('data-anim'))
			if(tab_body[j].getAttribute('data-anim') == index){
				tab_body[j].classList.add('activeContenu');
				tab_body[j].style="opacity:1"
			}else{
			tab_body[j].classList.remove('activeContenu');
			tab_body[j].style="display:none";

			}
			
		}
	})
}) 
