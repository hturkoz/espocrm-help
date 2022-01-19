define('my-module:views/call/fields/leads', 'crm:views/call/fields/leads', function (Dep) {

    return Dep.extend({

        setup: function () {
            Dep.prototype.setup.call(this);

            this.events['click [data-action="dial"]'] = function (e) {
                return this.actionDial(e);
            };
        },

        getDetailLinkHtml: function (id, name) {
            var html = Dep.prototype.getDetailLinkHtml.call(this, id, name);

            var key = this.foreignScope + '_' + id;
            var number = null;
            var phoneNumbersMap = this.model.get('phoneNumbersMap') || {};
            if (key in phoneNumbersMap) {
                number = phoneNumbersMap[key];
                var $html = $(html);

                var isModified = false;

                var $a = $html.find('a').filter(function() {
                    return this.href.match(/^tel\:/);
                }).each(function() {
                    if (!this.hasAttribute("data-phone-number")) {
                        $(this).attr('data-phone-number', number);
                        isModified = true;
                    }
                    if (!this.hasAttribute("data-action")) {
                        $(this).attr('data-action', 'dial');
                        isModified = true;
                    }
                });

                if (isModified) {
                    html = '<div>' + $html.html() + '</div>';
                }
            }

            return html;
        },
        
        actionDial: function (e)
        {
            e.preventDefault();
            var elem = e.currentTarget;

            if (!this.getUser().get('extension'))
            {
                 Espo.Ui.notify('Completez votre extension dans User', 'danger', 8000);
                 return;
            }

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
                        let url = '#' + this.model.urlRoot + '/edit/' + this.model.id;
                        this.getRouter().navigate(url, {trigger: true});
                        Espo.Ui.notify(response['message'], 'success', 8000);
                    }else{
                         Espo.Ui.notify( response['message'] , 'error', 2000);
                    }
                });
            //this.trigger('sync');
        },

    });

});
