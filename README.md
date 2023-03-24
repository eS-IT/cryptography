# Cryptography


## Beschreibung

Bei dieser Software handelt es sich um eine Erweiterung für das Open Source CMS Contao, mit der Werte ver- und entschlüsselt werden können.


## Autor

__e@sy Solutions IT:__ Patrick Froch <info@easySolutionsIT.de>


## Lizenz

Die Software wird unter LGPL veröffentlicht. Details sind in der Datei `LICENSE` zu finden.


## Voraussetzungen

- php: ^8.0
- contao/core-bundle: ~4.9|^5.1


## Installation

Die Installation geschieht über den ContaoManager. Einfach nach `esit/cryptography` suchen und installieren.


## Einrichtung

In die `.env`-Datei müssen zwei Werte eingetragen werden, das Passwort (`CRYPTOGRAPHY_SECRECT`) und die
Verschlüsselungsmethode (`CRYPTOGRAPHY_CIPHER`). Ein Beispiel sieht so aus:

```dotenv
CRYPTOGRAPHY_SECRECT="bhjRHnqCpgjqW3w94t34FjLnXCWvrhpJqsvN7VNfH9qHPKsm"
CRYPTOGRAPHY_CIPHER="aes-256-cbc"
```


## Verwendung

Der Helper kann einfach in eigene Klassen injected werden.

```php
MyClass
{

    private CryptographyHelper $cryptoHelper;

    public function __construct(CryptographyHelper $cryptoHelper)
    {
        $this->cryptoHelper = $cryptoHelper;
    }

    public function myTest(): void
    {
        $value      = 'Mein geheimer Teststring!';
        $encrypted  = $this->cryptoHelper->encrypt($value);
        $decrypted  = $this->cryptoHelper->decrypt($encrypted); // $value === $decrypted
    }
}
```

Beide Methoden nehmen als zweiten Parameter das Passwort entgegen. So können Werte mit unterschiedlichen Passwörtern
verschlüsselt werden, falls nicht das in der `.env`-Datei hinterlegte Standardpasswort (`CRYPTOGRAPHY_SECRECT`)
verwendet werden soll.