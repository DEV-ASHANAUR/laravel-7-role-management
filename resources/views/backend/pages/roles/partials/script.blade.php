<script>
    $("#checkpermissionAll").click(function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked', true);
        }else{
            $('input[type=checkbox]').prop('checked', false);
        }
        // console.log('checked',$(".form-check [type='checkbox']:checked").length);
        // implementAllChecked();
    });
    function checkPermissionByGroupName(className,checkThis){
        const groupIdName = $("#"+checkThis.id);
        const classCheckBox = $("."+className+' input');

        if(groupIdName.is(':checked')){
            classCheckBox.prop('checked', true);
        }else{
            classCheckBox.prop('checked', false);
        }
        implementAllChecked();
    }
    function checkSinglePermission(groupClassName,groupId,countPermission){
        const classCheckbox = $("."+groupClassName+' input');
        const groupIdBox = $("#"+groupId);
        if($("."+groupClassName+' input:checked').length == countPermission){
            groupIdBox.prop('checked',true);
        }else{
            groupIdBox.prop('checked',false);
        }
        implementAllChecked();
    }
    function implementAllChecked(){
        const countPermissions = {{ count($all_permission) }};
        const countPermissionGroup = {{ count($permission_group) }};
        // console.log('count',countPermissions + countPermissionGroup);
        // console.log('checked',$(".form-check [type='checkbox']:checked").length);
        if($(".form-check [type='checkbox']:checked").length >= (countPermissions + countPermissionGroup)){
            $("#checkpermissionAll").prop('checked',true);
        }else{
            $("#checkpermissionAll").prop('checked',false);
        }

        
    }
</script>