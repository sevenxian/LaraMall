$('#goods').bootstrapValidator({
    fields: {
        email: {
            validators: {
                notEmpty: {
                    message: '用户名不能为空!'
                }
            }
        },
    }
});