<?php

namespace Tiagofv\ServerSshMonitor\Tests;

use PHPUnit\Framework\TestCase;
use Tiagofv\ServerSshMonitor\ServerSshMonitor;

class ServerSshMonitorTest extends TestCase
{
    private $host = '18.231.22.134';
    private $user = 'ubuntu';
    private $port = 22;
    private $key = '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEAjm7BbfmPZUttZHXWjHstvw02xP3GzBaChagTtoCDtRHNdOWfefgcH56oLcqS
U5CtIFedJVVyA9EejHBAPHP1V5LwxtusIvbOShMslCOG/EN0ZOdeDJ5bxFab0WtKcre6kRv3ktLB
2E8ksisTOHZmvWzdnT/Lx4QNA1q6ndsM9p0zLGTO1eJ0a68yGx0EUW/oeOLl9XBjCW8Oj3vVCBwW
VZFlXLbZaPqaB1CPRODk4kuBnHAQgDGvfi6Z0pBZIMa7NPp5T7nl6krjRpjz4AAx2HiEVwGTz6Y4
owk1t1r3lFupsBHUBmgl8JXsHeRjBD9Z/IYjbnp6srfe9Jhf2rIO6wIDAQABAoIBAQCAv0zJhBRC
k/PGI15UjePEFsWzO1I/mPlSp6NqDLEBM55sVEPblJKXYmrTOZEbSGO2IHxECwCMwrLCb5UhEBBt
oL1Ug60Nzdqayso4/gQ+cxr7Osigz2RUDZW7rygUmk9ia81WQnxGcwPQqW8uUph8EbQhOFGTf6Hj
rleR6TfGkueKkjlDWiFelD+Pj4yNih5xHevyoTYRHC+O5twziYQV3csMFtXbxqTzIKQSKL1A9/pF
J496yAZ43dwHSdcyn475pCO2htb5Kl6dtTGEeIolZvhxW+QTaENFOS5bzKtYZGOmslHO9F1tstBh
l7aVJt0TMaww16AtAC/s6I99Wy3BAoGBANLqnyI7TWhPoEITveL3nb6fXKjC44SXdlIQ17uRh8sf
zUajSwA3izvX5xqRG5/UzWx+aCAPci7znXyNqtbukJF8ZuYDLq4ae240cUy6gyQXoYh4dynmnkWC
5c58sHFOYnI0SkNmCO0HNNTeqIGxHFkYmoZNEPW+i+HSgRcScXr1AoGBAKzgsEIQ1fOhTmJFMFZu
J5JhDzA7GgUwhL82ZNrysyrjenq10VdVDvrsbF0CQtXCsTviUY5RL8i436OXOEdWK8jhvMLbhPiv
ReY45I2x35Z083rZGCHd6jlimXusfwDFnJU6NOldhOLSAhASXCtAaQAnygNhoQlOm84yrtwz9vZf
AoGBAJZC9LBMk283GzM4IVXrlwRRQJAymCjER1VcDnXgzl+V/obOmwZCi/1Maabxrj6GOvuKauA8
YNq2UIKF4ypQt8oOWLiRl9YNo9X1oqpJTliORVSWjj7Zv/RBtzsOdh2i/FvkiOvPa5iCQ89L+by7
0zheYOhBS03oPHvbnoAzcYlpAoGBAIrF0rc1zIlFcyZvY939jsZyIz8UMk74I5dakpsvN6O19xuJ
2AHCxcOnBVWj+wKcxqjLg6w6f6EgxmULfqHFCmC21E+W56a5C+NCyDT2FAUy3EBBBJ4rBVoLTCl6
znhQKOGhV9f8ui9ZZU6BbntJuP/m8MLGG/7cmzVqefNJw3UBAoGALX+JWAx9CBVwQBv5VbukJIgC
KPFdIb2XUsilPDiupcy3nTQhFbfDIr7jFl0ZGO6vvX4LwoyNa8YlR/9GIrHH+MS39V5o+vuXU3lZ
tuy2iE0vZeL6HA2DHkdwoxSujZtWLgH4ukQtYunVtIjnuAAFdxnfxnbg+wnINMmMYLas1NQ=
-----END RSA PRIVATE KEY-----';
    /** @test */
    public function test_it_connects()
    {
        $con = new ServerSshMonitor($this->host, $this->user, $this->port, $this->key);
        return $this->assertTrue($con->initConnection());
    }
    /** @test */
    public function test_it_returns_cpu_average(){
        $con = new ServerSshMonitor($this->host, $this->user, $this->port, $this->key);
        return $this->assertIsFloat($con->getCPUAvg());
    }
    /** @test */
    public function test_it_returns_ram_usage(){
        $con = new ServerSshMonitor($this->host, $this->user, $this->port, $this->key);
        return $this->assertIsFloat($con->getRAMUsage());
    }
}
