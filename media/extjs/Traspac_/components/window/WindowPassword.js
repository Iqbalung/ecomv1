/**
 * @class Traspac.components.window.WindowForm
 * @extends Ext.window.Panel
 * requires 
 * @autor Rizky Atmawijaya
 * @date Rabu, 17 Sep 2014 19:13:29
 *
 * @params [config.form] this a object form in WindowForm
 *
 * @Description
 * Building component WindowForm for traspac application
 * This WindowForm is built by ....
 * This Class is created to be component for Window Form CRUD proses. like form adding or updating proses
 *
 *
 **/

Ext.define("Traspac.components.window.WindowPassword",{
	alternateClassName	: "Traspac.WindowPassword" ,
	extend				: "Traspac.components.window.WindowForm",
	alias				: 'widget.windowpassword',
	requires			: ['Traspac.components.window.MessageBox'],
	initComponent	: function(config) {
		var me=this;
		me.title='Ganti Password';
		me.url=Traspac.MANJAB_URL+'/main/ubahpassword';
		me.labelWidth= 150;
		me.width= 400;
		me.fields=[{
			fieldLabel	: 'Kata Sandi Lama',
			name		: 'old',
			itemId		: 'old',
			value		: ''
		}, {
			fieldLabel	: 'Kata Sandi',
			name		: 'new',
			inputType	: 'password',
			itemId		: 'new',
			invalidText	: 'Harus terdiri dari angka, huruf besar, huruf kecil dan tidak boleh ada spasi',
			listeners	: {
				blur: function(t){
					var password2 = this.nextSibling('[name=renew]');
					if(t.getValue() == password2.getValue()){
						password2.clearInvalid();
					} else{
						password2.markInvalid('Kata sandi tidak sama.');
					}
				}
			}
		}, {
			fieldLabel	: 'Konfirmasi Sandi',
			name		: 'renew',
			itemId		: 'KONFIRMASI_PASSWORD_BARU',
			inputType	: 'password',
			validator	: function(value) {
				var password1 = this.previousSibling('[name=new]');
				return (value === password1.getValue()) ? true : 'Kata sandi tidak sama.'
			}
		}];
		
		me.callParent([arguments]);
		
	}
});

