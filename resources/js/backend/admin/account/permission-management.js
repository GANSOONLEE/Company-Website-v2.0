// 获取所有权限的复选框元素
const permissionCheckboxes = document.querySelectorAll('.switch-box input[type="checkbox"]');

// 当权限复选框状态发生变化时触发事件
permissionCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        // 获取当前权限的名称
        const permissionName = this.name;
        
        // 获取当前权限所在的身份组级别
        const section = this.closest('section[data-role-level]');
        const level = parseInt(section.getAttribute('data-role-level'));
        
        // 如果选中了复选框
        if (this.checked) {
            // 遍历其他权限复选框
            permissionCheckboxes.forEach(otherCheckbox => {
                // 获取其他权限所在的身份组级别
                const otherSection = otherCheckbox.closest('section[data-role-level]');
                const otherLevel = parseInt(otherSection.getAttribute('data-role-level'));
                
                // 如果其他权限的名称以当前权限名称开头（继承关系），且级别小于等于当前身份组级别
                if (otherCheckbox.name.startsWith(permissionName) && otherLevel >= level) {
                    // 选中继承的权限复选框
                    otherCheckbox.checked = true;
                }
            });
        } else { // 如果取消了复选框
            // 遍历其他权限复选框
            permissionCheckboxes.forEach(otherCheckbox => {
                // 获取其他权限所在的身份组级别
                const otherSection = otherCheckbox.closest('section[data-role-level]');
                const otherLevel = parseInt(otherSection.getAttribute('data-role-level'));
                
                // 如果其他权限的名称以当前权限名称开头（继承关系），且级别小于等于当前身份组级别
                if (otherCheckbox.name.startsWith(permissionName) && otherLevel <= level) {
                    // 取消继承的权限复选框
                    otherCheckbox.checked = false;
                }
            });
        }
    });
});
