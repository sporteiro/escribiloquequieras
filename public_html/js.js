function agregarFoto()	{
	document.getElementById('inputsContenido').innerHTML="<span class='letritas'>URL de la imagen</span> <input type='text' id='inputImagen' class='imputis'\/\> <input type='button' onclick='agregarTagImg\(\)' value='Agregar' class='imputis'\/\>";
}
function agregarTagImg()	{
	var ruta=document.getElementById('inputImagen');
	var asunto=document.getElementById('asunto').value;
	if (ruta.value!='')	{
		document.getElementById('asunto').value=asunto+"<img src='"+ruta.value+"'/\>";
		ruta.value="";
		document.getElementById('inputsContenido').innerHTML="";
		}
	}
function agregarLink()	{
	document.getElementById('inputsContenido').innerHTML="<span class='letritas'>URL del enlace</span\><input type='text' id='inputLink' class='imputis'\/\><br /\><span class='letritas'>Texto a mostrar</span\><input type='text' id='inputLinkNombre' class='imputis' value='Click aca'/\>	<input type='button' onclick='agregarTagLink()' value='Agregar' class='imputis'/\>";


}
function agregarTagLink()	{
	var ruta=document.getElementById('inputLink');
	var nombre=document.getElementById('inputLinkNombre');
	var asunto=document.getElementById('asunto').value;
	if (ruta.value!='')	{
		document.getElementById('asunto').value=asunto+"<a href='"+ruta.value+"'\>"+nombre.value+"<\/a\>";
		ruta.value="";
		nombre.value="";
		document.getElementById('inputsContenido').innerHTML="";
		}
	}
function bold()	{
	document.getElementById('inputsContenido').innerHTML="<span class='letritas'>Texto en negrita</span\><input type='text' id='inputBold' class='imputis'/\> <input type='button' onclick='agregarTagBold()'value='Agregar' class='imputis'/\>";
}
function agregarTagBold()	{
	var ruta=document.getElementById('inputBold');
	var asunto=document.getElementById('asunto').value;
	if (ruta.value!='')	{
		document.getElementById('asunto').value=asunto+"<b>"+ruta.value+"<\/b\>";
		ruta.value="";
		document.getElementById('inputsContenido').innerHTML="";
		}
	}
function italic()	{
	document.getElementById('inputsContenido').innerHTML="<span class='letritas'>Texto en cursiva</span\><input type='text' id='inputItalic' class='imputis'/\> <input type='button' onclick='agregarTagItalic()' value='Agregar' class='imputis'/\>";
}
function agregarTagItalic()	{
	var ruta=document.getElementById('inputItalic');
	var asunto=document.getElementById('asunto').value;
	if (ruta.value!='')	{
		document.getElementById('asunto').value=asunto+"<i>"+ruta.value+"<\/i\>";
		ruta.value="";
		document.getElementById('inputsContenido').innerHTML="";
	}
}
