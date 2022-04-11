<?php
namespace Officialmeritinfos\NextropayPhp;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Officialmeritinfos\NextropayPhp\NextropayCurlRequests;
use Psr\Http\Message\StreamInterface;

/**
 * Nextropay PHP API Wrapper
 *
 * @link https://doc.nextropay.com/ Official Nextropay API Documentation.
 * @copyright (c) 2022, Nextropay.com
 *
 * Many API commands require a currency or currencies values to be passed. These are always in the
 * format of a currency ticker code. See https://doc.nextropay.com/supported-coins for these ticker codes,
 * located in the CODE column.
 *
 * When developing on Sandbox, ensure that the Env is set to TEST and switch over to LIVE when live.
 *
 * Always send your secret key as empty string when performing actions not Payout. We rely on the empty
 * string sent to determine if your secret key is needed.
 */
class NextropayAPI
{
    private $private_key = '';
    private $public_key = '';
    private $env;
    private $request_handler;

    /**
     * @param $public_key
     * @param $env
     * @param $private_key
     */
    public function __construct($public_key,$env,$private_key='')
    {
        // Set keys and format passed to class
        $this->private_key = $private_key;
        $this->public_key = $public_key;
        $this->env = $env;
        // Throw an error if the keys are not both passed
        try {
            if (empty($this->public_key)) {
                throw new Exception("Your secret and public keys are not both set!");
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
        // Initiate a cURL request object
        $this->request_handler = new NextropayCurlRequests($this->public_key,$this->env,$this->private_key);
    }

    /**
     * function CheckApiKey
     * Get basic account information.
     *
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function CheckApiKey()
    {
        return $this->request_handler->postRequests('check-key');
    }
    /**
     * function GetBusiness
     * Get Business information.
     *
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function GetBusiness($id)
    {
        return $this->request_handler->getRequests('account/business/'.$id);
    }
    /**
     * function UpdateBusiness
     * Updates Business information.
     *
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function UpdateBusiness($data)
    {
        return $this->request_handler->putRequests('account/business/update',$data);
    }
    /**
     * function CreateInvoice
     * Creates Invoice for payment
     *
     * @param $data
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function CreateInvoice($data)
    {
        return $this->request_handler->postRequests('invoice/create',$data);
    }
    /**
     * function GetInvoice
     * Retrieves Invoice details already created above
     * @param $id
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function GetInvoice($id)
    {
        return $this->request_handler->getRequests('invoice/'.$id.'/details');
    }
    /**
     * function UpdateInvoice
     * Updates the Invoice status from Partial payment to completed
     * @param $id
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function UpdateInvoice($id)
    {
        return $this->request_handler->putRequests('invoice/'.$id.'/update');
    }
    /**
     * function GetInvoiceSettlementStatus
     * Use this function to check the status of the invoice settlement
     * Unfortunately, this is only available for White Label
     * @param $id
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function GetInvoiceSettlementStatus($id)
    {
        return $this->request_handler->getRequests('invoice/'.$id.'/settlement');
    }
    /**
     * function CreatePayout
     * Creates Payouts/withdrawal
     *
     * @param $data
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function CreatePayout($data)
    {
        return $this->request_handler->postRequests('transfer/create',$data);
    }
    /**
     * function GetPayout
     * Retrieves Payout/Withdrawal details already created above
     * @param $id
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function GetPayout($id)
    {
        return $this->request_handler->getRequests('invoice/'.$id.'/details');
    }


    /** ------------------------------------------------ **/
    /** ------------ Miscellaneous Endpoint ------------ **/
    /** ------------------------------------------------ **/


    /**
     * function GetAccountBalance
     * Retrieves the Balance of your account before initiating payouts
     * @param $asset
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function GetAccountBalance($asset)
    {
        return $this->request_handler->getRequests('account-balance/'.$asset);
    }

    /**
     * function Rate
     * Get the system's exchange rate
     * @param $asset
     * @param $fiat
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function Rate($asset,$fiat='USD')
    {
        return $this->request_handler->getRequests('exchange-rate/'.$asset.'/'.$fiat);
    }

    /**
     * function GetBalance
     * Returns a collection of all account balance
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function GetBalance()
    {
        return $this->request_handler->postRequests('account-balance');
    }

    /**
     * function SupportedAssets
     * Returns a collection of all supported crypto assets
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function SupportedAssets()
    {
        return $this->request_handler->getRequests('supported-assets');
    }

    /**
     * function SupportedFiats
     * Returns a collection of all supported local currencies
     * @return StreamInterface|string
     * @throws GuzzleException
     */
    public function SupportedFiats()
    {
        return $this->request_handler->getRequests('supported-fiats');
    }
}