 var  formdata = false;
function try_upload_imgs(){
    
     var i = 0, len = this.files.length, img, reader, file;
   
            for( ; i < len; i++){
                file = this.files[i];
                
                
                if(!!file.type.match(/image.*/)){
                    
                    if(window.FileReader){
                        reader = new FileReader();
                       
                        reader.onloadend = function(e){
                            mostrar_img_subida(e.target.result);
                        };
                        reader.readAsDataURL(file);
                    }
                    
                    
                    if(formdata)
                        
                        
                        formdata.append('images[]', file);
                }
            }
            

   
}/*Termina la función*/


/**** *************** ********************* ********************* */
function mostrar_img_subida(source){
    var list = document.getElementById('lista-imagenes'),
    li   = document.createElement('li'),
    img  = document.createElement('img');        
    img.src = source;
    li.appendChild(img);
    list.appendChild(li);
}
/**/
function upload_img_server(f){
    
    
}
/******/




