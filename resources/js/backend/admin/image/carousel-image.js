
$(document).ready(function(){

    let draggableImageInstances = [];
    let draggablePanelArea = [];

    // create instance
    $('.image-box').each(function () {
        let draggableImage = new DraggableImage(this);
        draggableImageInstances.push(draggableImage);
    });

    // create instance
    $('.image-container').each(function () {
        let panelArea = new PanelArea(this);
        draggablePanelArea.push(panelArea);
    });

})

// Global Variable

let draggedImageId = null;

// Class Define

class DraggableImage{

    element;
    id;

    constructor(element){

        // Define variable
        this.element = element;
        this.id =  $(this.element).data('id')

        this.initInstance();

    }

    /**
     *  Init the instance method
     */

    initInstance(){

        // Dragstart
        this.element.addEventListener('dragstart', (event)=>{this.setImageData(event)});
    }

    setImageData(event){
        draggedImageId = this.id;
    }

    /**
     *  Static method
     */

    static resetDraggableImage(clonedImage ,relationPath){

        clonedImage[0].addEventListener('dragstart', function(event) {
            this.path = relationPath;
            draggedImageId = $(this).data('id');
        });
    }

}

class PanelArea{

    element;

    constructor(element){

        // Define variable
        this.element = element;

        // Init Method
        this.initInstance();
    }

    initInstance(){

        // Dragenter
        this.element.addEventListener('dragenter', (event)=>{this.toggleClass(event)});

        // Dragover
        this.element.addEventListener('dragover', (event)=>{this.stopDefaultMethod(event)});

        // Dragleave
        this.element.addEventListener('dragleave', (event)=>{this.toggleClass(event)});

        // Drop
        this.element.addEventListener('drop', (event)=>{this.dropOnTarget(event)});
    }

    stopDefaultMethod(event){
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move'; 
    }

    dropOnTarget(event){
        let draggedImage = $('.image-box[data-id="' + draggedImageId + '"]');
        let clonedImage = draggedImage.clone();
        $(this.element).append(clonedImage);

        let relationPath = $(clonedImage[0]).find('img.image-preview').data('path');
        let targetPanel = $(this.element).parent().data('panel');
        let fullName =  $(clonedImage[0]).find('p.image-name').text();

        // sent ImageData to ajax
        let request = new AjaxAPI();
        request.sentData(
            '/admin/image/carousel-image-update',
            {
                'relationPath': relationPath,
                'targetPanel': targetPanel,
                'fullName': fullName,
            }
        );

        // reset the image selector
        DraggableImage.resetDraggableImage(clonedImage, relationPath);

        // reset status, variable
        draggedImage.remove();
        draggedImageId = null;
        $(this.element).removeClass('active')
        clonedImage = null;
    }

    toggleClass(event){
        event.preventDefault();
        $(this.element).toggleClass('active')
    }

}

// API

class AjaxAPI{

    /**
     * @function constructor - Init Ajax Request
     * @param {string} url
     * @param {JSON} data - data you want to sent
     */

    constructor(){
        
    }

    sentData(url, data){

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'html',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                location.reload()
                // $('body').html(data)
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });

    }

}