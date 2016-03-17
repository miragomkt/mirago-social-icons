$.noConflict();
jQuery(document).ready(function($){
	jQuery('.color-field').wpColorPicker();
	icone_tipo_selecionado();
});

// Habilita e desabilita algumas opções do tema
function icone_tipo_selecionado() {
  if (document.getElementById("msi-icone-tipo").value == "0") {
    jQuery('.icone-personalizavel').hide();
  } else {
  	jQuery('.icone-personalizavel').show();
  }
}
