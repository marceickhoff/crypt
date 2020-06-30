# Crypt
![license](https://img.shields.io/github/license/marceickhoff/crypt)

Simple two-way string encryption and decryption for (relatively) safe password storage.

## Usage

You can use this tool to encrypt or decrypt strings. For this purpose, you will find several input fields.

Input field|Description
---|---
Text|A string to encrypt or decrypt. For convenience, there is a randomly generated String below the input field to use as a new password.
Key|The plaintext master password.
Initialization Vector|A random string that will be used as a initialization vector (salt) for the encryption. By default, there is already a randomly generated string entered. Make sure to use a different IV for each encryption.

After you have entered your data, press either ``Encrypt`` or ``Decypt``. This will take your entered data and perform the desired operation on it and display the results in the fields below.

Output field|Description
---|---
Result|The result of the operation. This will be either an encrypted or decrypted string.
Result to copy|For convenience. This contains the result of the operation as well as the used initialization vector. You can copy the contents of this field and store it.

Be sure to keep your master password (key) secret at all times and never store it together with the encrypted data.