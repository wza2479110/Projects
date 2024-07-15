using BusinessLib.Common;

namespace COMP3602Assign06
{
    public partial class ClientForm : Form
    {
        private Client _client;
        private ErrorProvider errorProvider1 = new ErrorProvider();

        public ClientForm()
        {
            InitializeComponent();
        }

        public ClientForm(Client client, bool isEditMode) : this()
        {
            _client = client;
            textBox_ClientCode.Enabled = !isEditMode;

            textBox_ClientCode.Text = _client.ClientCode;
            textBox_CompanyName.Text = _client.CompanyName;
            textBox_Address1.Text = _client.Address1;
            textBox_Address2.Text = _client.Address2;
            textBox_City.Text = _client.City;
            textBox_Province.Text = _client.Province;
            textBox_PostalCode.Text = _client.PostalCode;
            textBox_YTDSales.Text = _client.YTDSales.ToString("N2");
            checkBox_CreditHold.Checked = _client.CreditHold;
            textBox_Notes.Text = _client.Notes;

            if (isEditMode)
            {
                this.ActiveControl = textBox_CompanyName;
            }
        }

        private void ok_button_Click(object sender, EventArgs e)
        {
            _client.ClientCode = textBox_ClientCode.Text;
            _client.CompanyName = textBox_CompanyName.Text;
            _client.Address1 = textBox_Address1.Text;
            _client.Address2 = textBox_Address2.Text;
            _client.City = textBox_City.Text;
            _client.Province = textBox_Province.Text;
            _client.PostalCode = textBox_PostalCode.Text;
            _client.YTDSales = decimal.TryParse(textBox_YTDSales.Text, out decimal sales) ? sales : 0;
            _client.CreditHold = checkBox_CreditHold.Checked;
            _client.Notes = textBox_Notes.Text;

            var validator = new BusinessLib.Business.ClientValidation();
            if (validator.Validate(_client))
            {
                this.DialogResult = DialogResult.OK; // Set the dialog result to OK
                this.Close(); // Close the dialog
            }
            else
            {
                errorProvider1.SetError(ok_button, validator.ErrorMessage);
            }
        }


        private void cancel_button_Click(object sender, EventArgs e)
        {
            this.DialogResult = DialogResult.Cancel; // Set the dialog result to Cancel
            this.Close(); // Close the dialog without saving
        }
    }
}
