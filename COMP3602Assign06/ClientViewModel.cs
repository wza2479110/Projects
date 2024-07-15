using BusinessLib.Common;
using System.ComponentModel;
using System.Runtime.CompilerServices;

namespace COMP3602Assign06
{
    public class ClientViewModel : INotifyPropertyChanged
    {
        private Client _client;

        public event PropertyChangedEventHandler PropertyChanged;

        public ClientViewModel(Client client)
        {
            _client = client;
        }

        public string ClientCode
        {
            get { return _client.ClientCode; }
            set
            {
                if (_client.ClientCode != value)
                {
                    _client.ClientCode = value;
                    NotifyPropertyChanged();
                }
            }
        }

        // Repeat the above pattern for other properties like CompanyName, Address1, etc.
        public decimal YTDSales
        {
            get { return _client.YTDSales; }
            set
            {
                if (_client.YTDSales != value)
                {
                    _client.YTDSales = value;
                    NotifyPropertyChanged();
                }
            }
        }

        public bool CreditHold
        {
            get { return _client.CreditHold; }
            set
            {
                if (_client.CreditHold != value)
                {
                    _client.CreditHold = value;
                    NotifyPropertyChanged();
                }
            }
        }

        public string Notes
        {
            get { return _client.Notes; }
            set
            {
                if (_client.Notes != value)
                {
                    _client.Notes = value;
                    NotifyPropertyChanged();
                }
            }
        }

        protected void NotifyPropertyChanged([CallerMemberName] string propertyName = "")
        {
            PropertyChanged?.Invoke(this, new PropertyChangedEventArgs(propertyName));
        }
    }
}
