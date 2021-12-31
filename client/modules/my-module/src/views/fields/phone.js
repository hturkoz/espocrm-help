define('my-module:views/fields/phone', 'views/fields/phone', function (Dep) {

   return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);            
            this.events['click [data-action="dial"]'] = function (e) {
                return this.actionDial(e);
            };
        },

        afterRender: function () {
            Dep.prototype.afterRender.call(this);
            // your customizations executed after the field is rendered
        },

        actionDial: function (e)
        {
            e.preventDefault();
            

            if (!this.getUser().get('extension'))
            {
                 Espo.Ui.notify('Completez votre extension dans User', 'danger', 8000);
                 return;
            }
            let elem = e.currentTarget;
            let phoneNumber = $(elem).attr('data-phone-number');

            Espo.Ajax
                .postRequest('GlobalController/action/ciscoExecute', {
                    user: this.getUser(),
                    extension: this.getUser().get('extension'),
                    phoneNumber: phoneNumber
                })
                .then(response => {
                    if (response['status'] == true)
                    {
                        Espo.Ui.notify(response['message'], 'success', 8000);
                    }else{
                         Espo.Ui.notify( response['message'] , 'error', 2000);
                    }
                });
            //this.trigger('sync');
        }
    });
});