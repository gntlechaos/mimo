
var draggedImage;

$(document).ready(function(){

    function Counter(quill, options) {
        const container = document.querySelector('#word-count');
        quill.on(Quill.events.TEXT_CHANGE, () => {
            const text = quill.getText();
            count = text.split(/\s+/).length - 1;
            if(count == 1 && text.charCodeAt(0) == 10){
                count = 0;
            }
            container.innerText = count;
            container.setAttribute("plural",count !== 1);

        });
    }

    var imageIcon = '<svg version="1.1" width="16" style="fill: var(--font-main);" viewBox="0 0 18 18" height="18"><path d="M16 13.25A1.75 1.75 0 0 1 14.25 15H1.75A1.75 1.75 0 0 1 0 13.25V2.75C0 1.784.784 1 1.75 1h12.5c.966 0 1.75.784 1.75 1.75ZM1.75 2.5a.25.25 0 0 0-.25.25v10.5c0 .138.112.25.25.25h.94l.03-.03 6.077-6.078a1.75 1.75 0 0 1 2.412-.06L14.5 10.31V2.75a.25.25 0 0 0-.25-.25Zm12.5 11a.25.25 0 0 0 .25-.25v-.917l-4.298-3.889a.25.25 0 0 0-.344.009L4.81 13.5ZM7 6a2 2 0 1 1-3.999.001A2 2 0 0 1 7 6ZM5.5 6a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0Z"></path></svg>';

    Quill.register('modules/counter', Counter);


    const toolbarOptions = ['bold', 'italic', 'underline', 'strike', 'blockquote', 'clean' ,  { 'script': 'sub'}, { 'script': 'super' },'mimo-image'];

    const quill = new Quill('#main-text-editable', {
        placeholder: 'Comece a escrever aqui...',
        theme: 'bubble',
        modules: {
            toolbar: toolbarOptions,
            counter: true
        }
    });

    const imageButton = document.querySelector('.ql-mimo-image');
    imageButton.innerHTML = imageIcon;

    // Add event listener to your custom image button
    imageButton.addEventListener('click', function() {
        let range = quill.getSelection();
        if (range) {
          let [blot, offset] = quill.getLine(range.index);
          if (blot instanceof mimoImg) {
           
            if(blot.domNode.getAttribute('gallery') == 'false'){
                blot.domNode.setAttribute('gallery', 'true');
            } else {
                blot.domNode.setAttribute('gallery', 'false');
            }
                quill.root.blur();
                window.getSelection().removeAllRanges();
                quill.theme.tooltip.hide();
          }
        }
    });

    let BlockEmbed = Quill.import('blots/block/embed');

    class mimoImg extends BlockEmbed {
        static create(data) {
            let node = super.create();
            node.setAttribute('mimoImageContainer', true);
            node.setAttribute('gallery', 'false');

            let imgContainer = document.createElement('div');
            imgContainer.setAttribute('mimoImage', true);
            imgContainer.setAttribute('img-id', data.id);

            imgContainer.onclick = function(e){
                if(this.parentElement.getAttribute("gallery") == 'true'){
                    e.stopPropagation();
                } 
            }

            let imgChild = document.createElement('img');
            imgChild.src = data.src;

        
            imgContainer.appendChild(imgChild);
            node.appendChild(imgContainer);

            node.addEventListener('click', () => {
                let blot = Quill.find(node);
                if (blot) {
                  let index = quill.getIndex(blot);
                  let length = quill.getLength();
                  // If the blot is already selected, unselect it
                  if (quill.getSelection() && quill.getSelection().index == index && quill.getSelection().length == 1) {
                        quill.root.blur();
                        window.getSelection().removeAllRanges();
                  } else {
                    // Else select the blot
                    quill.setSelection(index, 1, Quill.sources.USER);
                  }
                }
            });
           
            node.addEventListener('drop', (event) => {
                event.preventDefault();
                
                var isGallery = node.getAttribute('gallery') == 'true';
                var newId = event.dataTransfer.getData('img-id');
                if(isGallery){
                    if(node.querySelectorAll('[img-id="'+newId+'"]').length == 0){

                        var newSrc = event.dataTransfer.getData('src');
                        var allImgs = node.querySelectorAll('[mimoImage]');
                        //var currentId = allImgs[allImgs.length-1].getAttribute('img-id');

                        event.stopPropagation(); 

                        let newimgContainer = document.createElement('div');
                        newimgContainer.setAttribute('mimoImage', true);
                        newimgContainer.setAttribute('img-id', newId);

                        newimgContainer.onclick = function(e){
                            if(this.parentElement.getAttribute("gallery") == 'true'){
                                e.stopPropagation();
                            } 
                        }  

                        let newImgChild = document.createElement('img');
                        newImgChild.src = newSrc;

                        let switchContainer = document.createElement('div');

                        switchContainer.setAttribute("class","switches");

                        let switchButton =  document.createElement('button');
                        switchButton.innerHTML = '<svg width="7" height="32" viewBox="0 0 7 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.00171 25.9343L0.228708 30.7073C0.157109 30.7765 0.100012 30.8593 0.0607492 30.9508C0.0214862 31.0423 0.000843397 31.1408 2.53082e-05 31.2403C-0.00079278 31.3399 0.0182303 31.4387 0.0559844 31.5308C0.0937385 31.623 0.149468 31.7067 0.21992 31.7771C0.290372 31.8475 0.374137 31.9031 0.466327 31.9408C0.558516 31.9785 0.657285 31.9974 0.756868 31.9965C0.856452 31.9956 0.954857 31.9748 1.04634 31.9355C1.13783 31.8961 1.22056 31.839 1.28971 31.7673L6.59271 26.4643C6.73316 26.3237 6.81205 26.133 6.81205 25.9343C6.81205 25.7355 6.73316 25.5449 6.59271 25.4043L1.28971 20.1003C1.14819 19.9637 0.958705 19.8882 0.762057 19.89C0.56541 19.8918 0.377337 19.9708 0.238346 20.1099C0.0993544 20.249 0.0205663 20.4372 0.0189509 20.6338C0.0173354 20.8305 0.0930218 21.0199 0.229708 21.1613L5.00171 25.9343Z" fill="#E6EDF3"/><path d="M1.99829 6.04603L6.77129 10.8204C6.84289 10.8896 6.89999 10.9725 6.93925 11.064C6.97851 11.1556 6.99916 11.254 6.99997 11.3536C7.00079 11.4532 6.98177 11.552 6.94402 11.6442C6.90626 11.7364 6.85053 11.8201 6.78008 11.8905C6.70963 11.9609 6.62586 12.0166 6.53367 12.0543C6.44148 12.0919 6.34272 12.1109 6.24313 12.11C6.14355 12.1091 6.04514 12.0883 5.95366 12.049C5.86217 12.0096 5.77944 11.9524 5.71029 11.8807L0.407291 6.57619C0.266841 6.43552 0.187952 6.24484 0.187952 6.04603C0.187952 5.84723 0.266841 5.65655 0.407291 5.51588L5.71029 0.210352C5.85181 0.0737597 6.0413 -0.00176993 6.23794 3.14989e-05C6.43459 0.00183293 6.62266 0.0808211 6.76165 0.219983C6.90065 0.359146 6.97943 0.547347 6.98105 0.744053C6.98266 0.940759 6.90698 1.13023 6.77029 1.27166L1.99829 6.04603Z" fill="#E6EDF3"/></svg>';
                        switchButton.onclick = function(e){
                            var imgIdL = this.parentElement.previousElementSibling.getAttribute("img-id");
                            var imgIdR = this.parentElement.nextElementSibling.getAttribute("img-id");

                            var masterContainer = this.parentElement.parentElement;
                            var imgL = masterContainer.querySelector('[img-id="'+imgIdL+'"]');
                            var imgR = masterContainer.querySelector('[img-id="'+imgIdR+'"]');
                            masterContainer.insertBefore(imgR,imgL);
                            masterContainer.insertBefore(this.parentElement,imgL);
                        }


                        switchContainer.appendChild(switchButton);

                        switchContainer.onclick = function(e){
                            if(this.parentElement.getAttribute("gallery") == 'true'){
                                e.stopPropagation();
                            } 
                        }

                        node.appendChild(switchContainer);
                        newimgContainer.appendChild(newImgChild);
                        node.appendChild(newimgContainer);
                        

                    } else{
                        event.stopPropagation(); 
                    }
                } 
              });
            
            
            return node;

        }

        
    }

    mimoImg.blotName = 'mimoImg';
    mimoImg.tagName = 'div';

    Quill.register(mimoImg);

    var images = document.querySelectorAll('#image-bank img');
    images.forEach(function(img) {
        img.addEventListener('dragstart', function(event) {
            event.dataTransfer.setData('img-id', this.getAttribute('img-id'));
            event.dataTransfer.setData('src', this.getAttribute('src'));
        });
    });

    quill.root.addEventListener('drop', function(event) {
        event.preventDefault();

        var imageId = event.dataTransfer.getData('img-id');
        var imageSrc = event.dataTransfer.getData('src');
        var range = quill.getSelection();
        quill.insertText(range.index, '\n', Quill.sources.USER);
        quill.insertEmbed(range.index + 1, 'mimoImg', {id:imageId,src:imageSrc}, Quill.sources.USER);
        quill.setSelection(range.index - 2, Quill.sources.SILENT);
        
      });
      
    


});
