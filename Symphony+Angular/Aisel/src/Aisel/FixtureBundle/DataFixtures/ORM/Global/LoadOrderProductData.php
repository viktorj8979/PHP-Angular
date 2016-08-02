<?php

/*
 * This file is part of the Aisel package.
 *
 * (c) Ivan Proskuryakov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Aisel\FixtureBundle\DataFixtures\ORM;

use Aisel\FixtureBundle\Model\XMLFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Order fixtures
 *
 * @author Ivan Proskuryakov <volgodark@gmail.com>
 */
class LoadOrderProductData extends XMLFixture implements OrderedFixtureInterface
{

    protected $fixturesName = array('global/aisel_order_from_product.xml');

    /**
     * Order manager
     * @return \Aisel\OrderBundle\Manager\OrderManager
     */
    protected function getOrderManager()
    {
        return $this->container->get('aisel.order.manager');
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->fixtureFiles as $file) {
            if (file_exists($file)) {
                $contents = file_get_contents($file);
                $XML = simplexml_load_string($contents);

                foreach ($XML->database->table as $table) {

                    $seller = $this->getReference('user_' . $table->column[1]);
                    $user = $this->getReference('user_' . $table->column[4]);

                    $orderInfo = array(
                        'payment_method' => (string)$table->column[3],
                        'billing_country' => (string)$table->column[6],
                        'billing_region' => (string)$table->column[7],
                        'billing_city' => (string)$table->column[8],
                        'billing_phone' => (string)$table->column[9],
                        'billing_comment' => (string)$table->column[10],
                        'locale' => (string)$table->column[2],
                    );
                    $productIds = explode(",", (string)$table->column[5]);
                    $products = array();

                    foreach ($productIds as $id) {
                        $products[] = $this->getReference('product_' . $id);
                    }
                    $order = $this
                        ->getOrderManager()
                        ->createOrderFromProducts(
                            $user,
                            $seller,
                            $products,
                            $orderInfo
                        );
                    $this->addReference('order_' . $table->column[0], $order);
                }
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 420;
    }
}
