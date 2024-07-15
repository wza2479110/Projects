using BusinessLib.Common;
using System.Data.SqlClient;

namespace BusinessLib.Data
{
    public class ClientRepository
    {
        private readonly string _connectionString;

        public ClientRepository()
        {
            _connectionString = "Server=localhost; " +
                               "Database=StudentDB; " +
                               "User Id=myuser; " +
                               "Password=mypassword; " +
                               "Encrypt=False; " +
                               "TrustServerCertificate=True; " +
                               "Connection Timeout=30;";
        }

        public List<Client> GetAllClients()
        {
            List<Client> clients = new List<Client>();

            using (var connection = new SqlConnection(_connectionString))
            {

                var commandText = "SELECT * FROM dbo.Client999999";
                var command = new SqlCommand(commandText, connection);

                try
                {
                    connection.Open();
                    using (var reader = command.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            var client = new Client
                            {
                                ClientCode = reader["ClientCode"] as string,
                                CompanyName = reader["CompanyName"] as string,
                                Address1 = reader["Address1"] as string,
                                Address2 = reader["Address2"] as string,
                                City = reader["City"] as string,
                                Province = reader["Province"] as string,
                                PostalCode = reader["PostalCode"] as string,
                                YTDSales = reader.IsDBNull(reader.GetOrdinal("YTDSales")) ? 0 : reader.GetDecimal(reader.GetOrdinal("YTDSales")),
                                CreditHold = reader.IsDBNull(reader.GetOrdinal("CreditHold")) ? false : reader.GetBoolean(reader.GetOrdinal("CreditHold")),
                                Notes = reader["Notes"] as string
                            };
                            clients.Add(client);
                        }
                    }
                }
                catch (SqlException e)
                {
                    Console.WriteLine($"SQL Exception: {e.Message}");
                }
                catch (Exception e)
                {
                    Console.WriteLine($"General Exception: {e.Message}");
                }
            }

            return clients;
        }

        public void AddClient(Client client)
        {
            const int maxClientCodeLength = 10; // Replace this with the actual max length from your database schema.
            if (client.ClientCode.Length > maxClientCodeLength)
            {
                throw new ArgumentException($"Client code must be at most {maxClientCodeLength} characters long.");
            }

            using (var connection = new SqlConnection(_connectionString))
            {
                var commandText = @"
                                    INSERT INTO dbo.Client999999 
                                    (ClientCode, CompanyName, Address1, Address2, City, Province, PostalCode, YTDSales, CreditHold, Notes) 
                                    VALUES 
                                    (@ClientCode, @CompanyName, @Address1, @Address2, @City, @Province, @PostalCode, @YTDSales, @CreditHold, @Notes)";

                using (var command = new SqlCommand(commandText, connection))
                {
                    // Add parameters to prevent SQL Injection
                    command.Parameters.AddWithValue("@ClientCode", client.ClientCode);
                    command.Parameters.AddWithValue("@CompanyName", client.CompanyName);
                    command.Parameters.AddWithValue("@Address1", client.Address1);
                    command.Parameters.AddWithValue("@Address2", client.Address2);
                    command.Parameters.AddWithValue("@City", client.City);
                    command.Parameters.AddWithValue("@Province", client.Province);
                    command.Parameters.AddWithValue("@PostalCode", client.PostalCode);
                    command.Parameters.AddWithValue("@YTDSales", client.YTDSales);
                    command.Parameters.AddWithValue("@CreditHold", client.CreditHold);
                    command.Parameters.AddWithValue("@Notes", client.Notes);

                    try
                    {
                        connection.Open();
                        command.ExecuteNonQuery();
                    }
                    catch (SqlException ex)
                    {
                        // Log and handle the SQL exception appropriately.
                        Console.WriteLine($"SQL Exception: {ex.Message}");
                        throw;
                    }
                }
            }
        }



        public void UpdateClient(Client client)
        {
            using (var connection = new SqlConnection(_connectionString))
            {
                var commandText = @"
                 UPDATE dbo.Client999999 
                 SET 
                    CompanyName = @CompanyName, 
                    Address1 = @Address1, 
                    Address2 = @Address2, 
                    City = @City, 
                    Province = @Province, 
                    PostalCode = @PostalCode, 
                    YTDSales = @YTDSales, 
                    CreditHold = @CreditHold, 
                    Notes = @Notes 
                WHERE ClientCode = @ClientCode";
                var command = new SqlCommand(commandText, connection);

                command.Parameters.AddWithValue("@ClientCode", client.ClientCode);
                command.Parameters.AddWithValue("@CompanyName", client.CompanyName);
                command.Parameters.AddWithValue("@Address1", client.Address1);
                command.Parameters.AddWithValue("@Address2", client.Address2);
                command.Parameters.AddWithValue("@City", client.City);
                command.Parameters.AddWithValue("@Province", client.Province);
                command.Parameters.AddWithValue("@PostalCode", client.PostalCode);
                command.Parameters.AddWithValue("@YTDSales", client.YTDSales);
                command.Parameters.AddWithValue("@CreditHold", client.CreditHold);
                command.Parameters.AddWithValue("@Notes", client.Notes);

                connection.Open();
                command.ExecuteNonQuery();
            }
        }

        public void DeleteClient(string clientCode)
        {
            using (var connection = new SqlConnection(_connectionString))
            {
                var commandText = "DELETE FROM dbo.Client999999 WHERE ClientCode = @ClientCode";
                var command = new SqlCommand(commandText, connection);
                command.Parameters.AddWithValue("@ClientCode", clientCode);
                connection.Open();
                command.ExecuteNonQuery();
            }
        }
    }
}
