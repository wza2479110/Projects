using BusinessLib.Common;
using System.Text.RegularExpressions;

namespace BusinessLib.Business
{
    public class ClientValidation
    {
        public string ErrorMessage { get; private set; }

        public bool Validate(Client client)
        {
            if (string.IsNullOrWhiteSpace(client.ClientCode))
            {
                ErrorMessage = "Client code cannot be empty.";
                return false;
            }
            if (string.IsNullOrWhiteSpace(client.CompanyName))
            {
                ErrorMessage = "Company name cannot be empty.";
                return false;
            }
            if (string.IsNullOrWhiteSpace(client.Address1))
            {
                ErrorMessage = "Address1 cannot be empty.";
                return false;
            }
            if (string.IsNullOrWhiteSpace(client.Province) || !IsValidProvince(client.Province))
            {
                ErrorMessage = "Province cannot be empty and must be in the format AA.";
                return false;
            }
            if (string.IsNullOrWhiteSpace(client.PostalCode) || !IsValidPostalCode(client.PostalCode))
            {
                ErrorMessage = "Postal Code must be in the format A9A 9A9.";
                return false;
            }

            // All checks passed
            ErrorMessage = string.Empty;
            return true;
        }

        private bool IsValidProvince(string province)
        {
            // province should be two uppercase letters. Adjust the pattern if needed.
            return Regex.IsMatch(province, @"^[A-Z]{2}$");
        }

        private bool IsValidPostalCode(string postalCode)
        {
            // Canadian Postal Code pattern. Adjust the pattern if needed for different formats.
            return Regex.IsMatch(postalCode, @"^[A-Z]\d[A-Z] \d[A-Z]\d$");
        }
    }
}
