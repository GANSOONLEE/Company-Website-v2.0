
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

/**
 * checkbox toggle status
 */

const permissionCheckboxes = document.querySelectorAll('.switch-box input[type="checkbox"]');

permissionCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const permissionName = this.name;
        
        const section = this.closest('section[data-role-level]');
        const level = parseInt(section.getAttribute('data-role-level'));
        
        if (this.checked) {
            permissionCheckboxes.forEach(otherCheckbox => {
                const otherSection = otherCheckbox.closest('section[data-role-level]');
                const otherLevel = parseInt(otherSection.getAttribute('data-role-level'));
                
                if (otherCheckbox.name.startsWith(permissionName) && otherLevel >= level) {
                    otherCheckbox.checked = true;
                }
            });
        } else {
            permissionCheckboxes.forEach(otherCheckbox => {
                const otherSection = otherCheckbox.closest('section[data-role-level]');
                const otherLevel = parseInt(otherSection.getAttribute('data-role-level'));
                
                if (otherCheckbox.name.startsWith(permissionName) && otherLevel <= level) {
                    otherCheckbox.checked = false;
                }
            });
        }
    });
});

// update permission

$('.submit-button').click(updatePermission);

function updatePermission(){
    let panelContent = $(this).closest('div.panel-footer').closest('section.panel');
    let checkboxes = panelContent.find('input[type="checkbox"]:not([disabled])');
    let permissions = [];

    checkboxes.each(function() {
        let checkbox = $(this);
        let name = checkbox.attr('name');
        let checked = checkbox.prop('checked');

        permissions.push({
            name: name,
            checked: checked
        });
    });

    let role = $(this).data('role');

    let request = new AjaxAPI();
    request.sentData(
        '/admin/account/update-permission',
        {
            'role': role,
            'permissions': JSON.stringify(permissions),
        },
    );
}

class AjaxAPI{

    /**
     * @function constructor - Init Ajax Request
     * @param {string} url
     * @param {JSON} data - data you want to sent
     */

    constructor(){
        
    }

    sentData(url, data, refresh=true){

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'html',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if(refresh){
                    location.reload()
                }
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });

    }

}