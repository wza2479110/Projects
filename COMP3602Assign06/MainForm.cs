using BusinessLib.Data;
using BusinessLib.Common;

namespace COMP3602Assign06
{
    public partial class MainForm : Form
    {
        private ClientRepository _clientRepository;
        private BindingSource _bindingSource;

        public MainForm()
        {
            InitializeComponent();
            _clientRepository = new ClientRepository();
            _bindingSource = new BindingSource();

            this.Load += MainForm_Load;
        }

        private void MainForm_Load(object sender, EventArgs e)
        {
            LoadClientsData();
            setupDataGridView();
            dataGridView1.ClearSelection();
            dataGridView1.CurrentCell = null;
            dataGridView1.Anchor = AnchorStyles.Top | AnchorStyles.Bottom | AnchorStyles.Left | AnchorStyles.Right;
        }




        private void LoadClientsData()
        {
            try
            {
                var clients = _clientRepository.GetAllClients();
                _bindingSource.DataSource = clients;
                dataGridView1.DataSource = _bindingSource;
            }
            catch (Exception ex)
            {
                MessageBox.Show($"Failed to load data: {ex.Message}", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
        }

        private void setupDataGridView()
        {
            // Configure DataGridView properties 
            dataGridView1.SelectionMode = DataGridViewSelectionMode.FullRowSelect;
            dataGridView1.MultiSelect = false;
            dataGridView1.AllowUserToAddRows = false;
            dataGridView1.EditMode = DataGridViewEditMode.EditProgrammatically;
            dataGridView1.AllowUserToOrderColumns = false;
            dataGridView1.AllowUserToResizeColumns = true;
            dataGridView1.AllowUserToResizeRows = false;
            dataGridView1.ColumnHeadersDefaultCellStyle.Font = new Font(DataGridView.DefaultFont, FontStyle.Bold);
            dataGridView1.RowHeadersVisible = false;
            dataGridView1.AutoGenerateColumns = false;

            // Add columns
            if (dataGridView1.Columns.Count == 0)
            {
                dataGridView1.Columns.Add(CreateTextBoxColumn("ClientCode", "Client Code", 100));
                dataGridView1.Columns.Add(CreateTextBoxColumn("CompanyName", "Company Name", 300));
                dataGridView1.Columns.Add(CreateTextBoxColumn("Address1", "Address 1", 150));
                dataGridView1.Columns.Add(CreateTextBoxColumn("Address2", "Address 2", 150));
                dataGridView1.Columns.Add(CreateTextBoxColumn("City", "City", 100));
                dataGridView1.Columns.Add(CreateTextBoxColumn("Province", "Province", 75));
                dataGridView1.Columns.Add(CreateTextBoxColumn("PostalCode", "Postal Code", 100));
                dataGridView1.Columns.Add(CreateTextBoxColumn("YTDSales", "YTD Sales", 100));
                dataGridView1.Columns.Add(CreateCheckBoxColumn("CreditHold", "Credit Hold", 100));
                dataGridView1.Columns.Add(CreateTextBoxColumn("Notes", "Notes", 200));
            }
            // Adjust the last column to fill the space
            dataGridView1.Columns[dataGridView1.Columns.Count - 1].AutoSizeMode = DataGridViewAutoSizeColumnMode.Fill;

            // Bind the DataGridView to the BindingSource
            dataGridView1.DataSource = _bindingSource;

            dataGridView1.DataBindingComplete += (s, e) =>
            {
                dataGridView1.ClearSelection();
            };
        }

        private DataGridViewTextBoxColumn CreateTextBoxColumn(string dataPropertyName, string headerText, int width, string format = null)
        {
            DataGridViewTextBoxColumn column = new DataGridViewTextBoxColumn
            {
                Name = dataPropertyName + "Column",
                DataPropertyName = dataPropertyName,
                HeaderText = headerText,
                Width = width,
                SortMode = DataGridViewColumnSortMode.NotSortable,
                DefaultCellStyle = new DataGridViewCellStyle { Format = format }
            };
            return column;
        }

        private DataGridViewCheckBoxColumn CreateCheckBoxColumn(string dataPropertyName, string headerText, int width)
        {
            DataGridViewCheckBoxColumn column = new DataGridViewCheckBoxColumn
            {
                Name = dataPropertyName + "Column",
                DataPropertyName = dataPropertyName,
                HeaderText = headerText,
                Width = width,
                SortMode = DataGridViewColumnSortMode.NotSortable,
            };
            return column;
        }

        private void add_button_Click(object sender, EventArgs e)
        {
            var newClient = new BusinessLib.Common.Client();
            ClientForm clientForm = new ClientForm(newClient, isEditMode: false);
            clientForm.Text = "Add Client Dialog";

            if (clientForm.ShowDialog() == DialogResult.OK)
            {
                _clientRepository.AddClient(newClient);
                LoadClientsData(); // Refresh the DataGridView
            }
        }

        private void edit_button_Click(object sender, EventArgs e)
        {

            if (dataGridView1.SelectedRows.Count > 0)
            {
                Client clientToEdit = dataGridView1.SelectedRows[0].DataBoundItem as Client;
                ClientForm clientForm = new ClientForm(clientToEdit, isEditMode: true);
                clientForm.Text = "Edit Client Dialog";

                if (clientForm.ShowDialog() == DialogResult.OK)
                {
                    _clientRepository.UpdateClient(clientToEdit); // Updates the client in the repository
                    LoadClientsData(); // Refresh the DataGridView

                }
            }
            else
            {
                MessageBox.Show("Please select a client to edit.");
            }
        }

        private void delete_button_Click(object sender, EventArgs e)
        {
            if (dataGridView1.SelectedRows.Count > 0)
            {
                Client clientToDelete = dataGridView1.SelectedRows[0].DataBoundItem as Client;

                // Check if the Confirm Delete checkbox is checked
                bool confirmDelete = chkConfirmDelete.Checked;
                if (confirmDelete)
                {
                    // Show confirmation dialog
                    DialogResult confirmation = MessageBox.Show(
                        $"Are you sure you want to delete {clientToDelete.CompanyName}?",
                        "Confirm Delete",
                        MessageBoxButtons.YesNo,
                        MessageBoxIcon.Question);

                    // If the user clicked "No", abort the delete operation
                    if (confirmation != DialogResult.Yes)
                    {
                        return; // Exit the event handler
                    }
                }

                // Proceed with the deletion as the user has confirmed or confirmation is disabled
                _clientRepository.DeleteClient(clientToDelete.ClientCode);
                LoadClientsData();
            }
            else
            {
                MessageBox.Show("Please select a client to delete.");
            }
        }

    }
}
