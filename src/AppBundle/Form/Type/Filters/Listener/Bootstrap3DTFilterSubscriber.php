<?php 

namespace AppBundle\Form\Type\Filters\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Lexik\Bundle\FormFilterBundle\Event\GetFilterConditionEvent;

/**
 * Bootstrap3 Date and Time Subscriber 
 * 
 * Bootstrap3DTFilterSubscriber
 */
class Bootstrap3DTFilterSubscriber implements EventSubscriberInterface
{
	/**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'lexik_form_filter.apply.orm.filter_bootstrap3_date' => array('filterBootstrap3Date'),
            'lexik_form_filter.apply.dbal.filter_bootstrap3_date' => array('filterBootstrap3Date'),
            'lexik_form_filter.apply.orm.filter_bootstrap3_datetime' => array('filterBootstrap3DateTime'),
            'lexik_form_filter.apply.dbal.filter_bootstrap3_datetime' => array('filterBootstrap3DateTime'),
            'lexik_form_filter.apply.orm.filter_bootstrap3_date_range' => array('filterBootstrap3DateRange'),
            'lexik_form_filter.apply.dbal.filter_bootstrap3_date_range' => array('filterBootstrap3DateRange'),
            'lexik_form_filter.apply.orm.filter_bootstrap3_date_range' => array('filterBootstrap3DateRange'),
            'lexik_form_filter.apply.dbal.filter_bootstrap3_date_range' => array('filterBootstrap3DateRange'),
            'lexik_form_filter.apply.orm.filter_bootstrap3_datetime_range' => array('filterBootstrap3DateTimeRange'),
            'lexik_form_filter.apply.dbal.filter_bootstrap3_datetime_range' => array('filterBootstrap3DateTimeRange'),
        );
    }

    public function filterBootstrap3Date(GetFilterConditionEvent $event)
    {
        $values = $event->getValues();

        if ($values['value'] instanceof \DateTime) {
            $expr = $event->getFilterQuery()->getExpr();
            $field = $event->getField();
            $paramNamePrefix = str_replace('.', '_', $field);

            $fromDate = clone $values['value'];
            $fromDate->setTime(0, 0, 0);

            $toDate = clone $values['value'];
            $toDate->setTime(23, 59, 59);

            $event->setCondition(
                $expr->andX(
                    $expr->gte($field, ':' . $paramNamePrefix . 'From'),
                    $expr->lte($field, ':' . $paramNamePrefix . 'To')
                ),
                array(
                    $paramNamePrefix . 'From' => $fromDate,
                    $paramNamePrefix . 'To'   => $toDate,
                )
            );
        }
    }

    public function filterBootstrap3DateTime(GetFilterConditionEvent $event)
    {
        $values = $event->getValues();

        $dt = $values['value'];

        if ($dt instanceof \DateTime) {
            $expr = $event->getFilterQuery()->getExpr();
            $field = $event->getField();
            $paramNamePrefix = str_replace('.', '_', $field);

            $fromDateTime = clone $dt;
            $fromDateTime->setTime($dt->format('H'), $dt->format('i'), 0);

            $toDateTime = clone $dt;
            $toDateTime->setTime($dt->format('H'), $dt->format('i'), 59);

            $event->setCondition(
                $expr->andX(
                    $expr->gte($field, ':' . $paramNamePrefix . 'From'),
                    $expr->lte($field, ':' . $paramNamePrefix . 'To')
                ),
                array(
                    $paramNamePrefix . 'From' => $fromDateTime,
                    $paramNamePrefix . 'To'   => $toDateTime,
                )
            );
        }
    }

    public function filterBootstrap3DateRange(GetFilterConditionEvent $event)
    {
        $values = $event->getValues();

        $leftDate = $values['value']['left_date'][0];
        $rightDate = $values['value']['right_date'][0];

        if ($leftDate instanceof \DateTime || $rightDate instanceof \DateTime) {
            $expr = $event->getFilterQuery()->getExpr();
            $field = $event->getField();
            $paramNamePrefix = str_replace('.', '_', $field);

            $parameters = array(); 

            if ($leftDate instanceof \DateTime) {
                $leftDate->setTime(0, 0, 0);
                $leftExpr = $expr->gte($field, ':' . $paramNamePrefix . 'From');
                $parameters[$paramNamePrefix . 'From'] = $leftDate;
            }

            if ($rightDate instanceof \DateTime) {
                $rightDate->setTime(23, 59, 59);
                $rightExpr = $expr->lte($field, ':' . $paramNamePrefix . 'To');
                $parameters[$paramNamePrefix . 'To'] = $rightDate;
            }

            if ($leftDate instanceof \DateTime && $rightDate instanceof \DateTime) {
                $theExpr = $expr->andX($leftExpr, $rightExpr);
            } else {
                $theExpr = $leftDate instanceof \DateTime ? $leftExpr : $rightExpr;
            }

            $event->setCondition($theExpr, $parameters);
        }
    }

    public function filterBootstrap3DateTimeRange(GetFilterConditionEvent $event)
    {
    	$values = $event->getValues();

        $leftDate = $values['value']['left_datetime'][0];
        $rightDate = $values['value']['right_datetime'][0];

        if ($leftDate instanceof \DateTime || $rightDate instanceof \DateTime) {
            $expr = $event->getFilterQuery()->getExpr();
            $field = $event->getField();
            $paramNamePrefix = str_replace('.', '_', $field);

            $parameters = array(); 

            if ($leftDate instanceof \DateTime) {
                $leftDate->setTime($leftDate->format('H'), $leftDate->format('i'), 0);
                $leftExpr = $expr->gte($field, ':' . $paramNamePrefix . 'From');
                $parameters[$paramNamePrefix . 'From'] = $leftDate;
            }

            if ($rightDate instanceof \DateTime) {
                $rightDate->setTime($rightDate->format('H'), $rightDate->format('i'), 59);
                $rightExpr = $expr->lte($field, ':' . $paramNamePrefix . 'To');
                $parameters[$paramNamePrefix . 'To'] = $rightDate;
            }

            if ($leftDate instanceof \DateTime && $rightDate instanceof \DateTime) {
                $theExpr = $expr->andX($leftExpr, $rightExpr);
            } else {
                $theExpr = $leftDate instanceof \DateTime ? $leftExpr : $rightExpr;
            }

            $event->setCondition($theExpr, $parameters);
        }
    }
}