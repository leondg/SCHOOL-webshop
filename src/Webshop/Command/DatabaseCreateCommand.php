<?php

namespace Webshop\Command;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Comparator;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Silex\Application as SilexApplication;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseCreateCommand extends Command
{
    private $app;

    public function __construct(SilexApplication $app)
    {
        $this->app = $app;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('database:create')
            ->setDescription('Creates or updates the database tables')
            ->addOption('force-reload', 'f', InputOption::VALUE_NONE, 'Deletes all tables and re-creates them');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var Connection $connection */
        $connection = $this->app['db'];

        $schema = new Schema();

        $accountTable = $schema->createTable('account');
        $accountTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $accountTable->addColumn('username', Type::STRING, ['length' => 20]);
        $accountTable->addColumn('password', Type::STRING, ['length' => 255]);
        $accountTable->addColumn('email', Type::STRING, ['length' => 255]);
        $accountTable->addColumn('firstname', Type::STRING, ['length' => 50]);
        $accountTable->addColumn('lastname', Type::STRING, ['length' => 50]);
        $accountTable->addColumn('phonenumber', Type::STRING, ['length' => 20]);
        $accountTable->addColumn('locale', Type::STRING, ['length' => 2]);
        $accountTable->addColumn('status', Type::STRING, ['length' => 20]);
        $accountTable->addColumn('createdon', Type::DATETIME);
        $accountTable->addColumn('updatedon', Type::DATETIME);
        $accountTable->setPrimaryKey(['id']);
        $accountTable->addUniqueIndex(['username']);
        $accountTable->addIndex(['email'], 'account_index');

        $accountAddressTable = $schema->createTable('account_address');
        $accountAddressTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $accountAddressTable->addColumn('account_id', Type::INTEGER, ['length' => 10]);
        $accountAddressTable->addColumn('name', Type::STRING, ['length' => 40, 'notnull' => false]);
        $accountAddressTable->addColumn('street', Type::STRING, ['length' => 50]);
        $accountAddressTable->addColumn('number', Type::STRING, ['length' => 10]);
        $accountAddressTable->addColumn('zipcode', Type::STRING, ['length' => 10]);
        $accountAddressTable->addColumn('residence', Type::STRING, ['length' => 50]);
        $accountAddressTable->addColumn('country', Type::STRING, ['length' => 2]);
        $accountAddressTable->addColumn('status', Type::STRING, ['length' => 20]);
        $accountAddressTable->addColumn('createdon', Type::DATETIME);
        $accountAddressTable->addColumn('updatedon', Type::DATETIME);
        $accountAddressTable->setPrimaryKey(['id']);
        $accountAddressTable->addForeignKeyConstraint($accountTable, ['account_id'], ['id'], [], 'account_address_account');

        $searchHistoryTable = $schema->createTable('search_history');
        $searchHistoryTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $searchHistoryTable->addColumn('account_id', Type::INTEGER, ['length' => 10, 'notnull' => false]);
        $searchHistoryTable->addColumn('search', Type::STRING, ['length' => 255, 'notnull' => false]);
        $searchHistoryTable->addColumn('status', Type::STRING, ['length' => 20]);
        $searchHistoryTable->addColumn('createdon', Type::DATETIME);
        $searchHistoryTable->addColumn('updatedon', Type::DATETIME);
        $searchHistoryTable->setPrimaryKey(['id']);
        $searchHistoryTable->addForeignKeyConstraint($accountTable, ['account_id'], ['id'], [], 'search_history_account');

        $wishListTable = $schema->createTable('wish_list');
        $wishListTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $wishListTable->addColumn('account_id', Type::INTEGER, ['length' => 10]);
        $wishListTable->addColumn('name', Type::STRING, ['length' => 40, 'notnull' => false]);
        $wishListTable->addColumn('status', Type::STRING, ['length' => 20]);
        $wishListTable->addColumn('createdon', Type::DATETIME);
        $wishListTable->addColumn('updatedon', Type::DATETIME);
        $wishListTable->setPrimaryKey(['id']);
        $wishListTable->addForeignKeyConstraint($accountTable, ['account_id'], ['id'], [], 'wish_list_account');

        $paymentMethodTable = $schema->createTable('payment_method');
        $paymentMethodTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $paymentMethodTable->addColumn('name', Type::STRING, ['length' => 40, 'notnull' => false]);
        $paymentMethodTable->addColumn('price', Type::INTEGER, ['length' => 10]);
        $paymentMethodTable->addColumn('status', Type::STRING, ['length' => 20]);
        $paymentMethodTable->addColumn('createdon', Type::DATETIME);
        $paymentMethodTable->addColumn('updatedon', Type::DATETIME);
        $paymentMethodTable->setPrimaryKey(['id']);

        $discountCodeTable = $schema->createTable('discount_code');
        $discountCodeTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $discountCodeTable->addColumn('code', Type::STRING, ['length' => 20]);
        $discountCodeTable->addColumn('price', Type::INTEGER, ['length' => 10]);
        $discountCodeTable->addColumn('name', Type::STRING, ['length' => 40]);
        $discountCodeTable->addColumn('description', Type::TEXT);
        $discountCodeTable->addColumn('reusable', Type::INTEGER, ['length' => 1]);
        $discountCodeTable->addColumn('status', Type::STRING, ['length' => 20]);
        $discountCodeTable->addColumn('createdon', Type::DATETIME);
        $discountCodeTable->addColumn('updatedon', Type::DATETIME);
        $discountCodeTable->setPrimaryKey(['id']);
        $discountCodeTable->addUniqueIndex(['code']);

        $orderTable = $schema->createTable('order');
        $orderTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $orderTable->addColumn('account_id', Type::INTEGER, ['length' => 10]);
        $orderTable->addColumn('payment_method_id', Type::INTEGER, ['length' => 10]);
        $orderTable->addColumn('discount_code_id', Type::INTEGER, ['length' => 10, 'notnull' => false]);
        $orderTable->addColumn('deliverymethod', Type::STRING, ['length' => 20]);
        $orderTable->addColumn('status', Type::STRING, ['length' => 20]);
        $orderTable->addColumn('paymentstatus', Type::STRING, ['length' => 20]);
        $orderTable->addColumn('createdon', Type::DATETIME);
        $orderTable->addColumn('updatedon', Type::DATETIME);
        $orderTable->setPrimaryKey(['id']);
        $orderTable->addForeignKeyConstraint($accountTable, ['account_id'], ['id'], [], 'order_account');
        $orderTable->addForeignKeyConstraint($paymentMethodTable, ['payment_method_id'], ['id'], [], 'order_payment_method');
        $orderTable->addForeignKeyConstraint($discountCodeTable, ['discount_code_id'], ['id'], [], 'order_discount_code');

        $productTable = $schema->createTable('product');
        $productTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $productTable->addColumn('name', Type::STRING, ['length' => 100]);
        $productTable->addColumn('brand', Type::STRING, ['length' => 40, 'notnull' => false]);
        $productTable->addColumn('category', Type::STRING, ['length' => 20, 'notnull' => false]);
        $productTable->addColumn('price', Type::INTEGER, ['length' => 10]);
        $productTable->addColumn('msrp', Type::INTEGER, ['length' => 10, 'notnull' => false]);
        $productTable->addColumn('stock', Type::INTEGER, ['length' => 10]);
        $productTable->addColumn('options', Type::TEXT, ['notnull' => false]);
        $productTable->addColumn('status', Type::STRING, ['length' => 20]);
        $productTable->addColumn('createdon', Type::DATETIME);
        $productTable->addColumn('updatedon', Type::DATETIME);
        $productTable->setPrimaryKey(['id']);
        $productTable->addUniqueIndex(['name']);

        $orderLineTable = $schema->createTable('order_line');
        $orderLineTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $orderLineTable->addColumn('order_id', Type::INTEGER, ['length' => 10]);
        $orderLineTable->addColumn('product_id', Type::INTEGER, ['length' => 10]);
        $orderLineTable->addColumn('price', Type::INTEGER, ['length' => 10]);
        $orderLineTable->addColumn('status', Type::STRING, ['length' => 20]);
        $orderLineTable->addColumn('createdon', Type::DATETIME);
        $orderLineTable->addColumn('updatedon', Type::DATETIME);
        $orderLineTable->setPrimaryKey(['id']);
        $orderLineTable->addForeignKeyConstraint($orderTable, ['order_id'], ['id'], [], 'order_line_order');
        $orderLineTable->addForeignKeyConstraint($productTable, ['product_id'], ['id'], [], 'order_line_product');

        $wishListLineTable = $schema->createTable('wish_list_line');
        $wishListLineTable->addColumn('id', Type::INTEGER, ['length' => 10, 'autoincrement' => true]);
        $wishListLineTable->addColumn('wish_list_id', Type::INTEGER, ['length' => 10]);
        $wishListLineTable->addColumn('product_id', Type::INTEGER, ['length' => 10]);
        $wishListLineTable->addColumn('price', Type::INTEGER, ['length' => 10]);
        $wishListLineTable->addColumn('createdon', Type::DATETIME);
        $wishListLineTable->addColumn('updatedon', Type::DATETIME);
        $wishListLineTable->setPrimaryKey(['id']);
        $wishListLineTable->addForeignKeyConstraint($wishListTable, ['wish_list_id'], ['id'], [], 'wish_list_line_wish_list');
        $wishListLineTable->addForeignKeyConstraint($productTable, ['product_id'], ['id'], [], 'wish_list_line_product');

        $schemaManager = $connection->getSchemaManager();
        $platform = $schemaManager->getDatabasePlatform();

        $current = $schemaManager->createSchema();

        if ($input->getOption('force-reload')) {
            $diff = Comparator::compareSchemas($current, $schema)
                ->toSql($platform);
        } else {
            $diff = Comparator::compareSchemas($current, $schema)
                ->toSaveSql($platform);
        }

        foreach ($diff as $update) {
            $connection->exec($update);
            $output->writeln('Executing update '.$update);
        }
    }
}
