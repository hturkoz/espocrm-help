define('my-module:views/meeting/fields/leads', 'crm:views/meeting/fields/attendees', function (Dep) {

    return Dep.extend({

        getSelectFilters: function () {
            if (this.model.get('parentType') == 'Patient' && this.model.get('parentId')) {
                var nameHash = {};
                nameHash[this.model.get('parentId')] = this.model.get('parentName');
                return {
                    'patients': {
                        type: 'linkedWith',
                        value: [this.model.get('parentId')],
                        data: {
                            type: 'anyOf',
                            nameHash: nameHash,
                        }
                    }
                };
            }
        },
    });

});
