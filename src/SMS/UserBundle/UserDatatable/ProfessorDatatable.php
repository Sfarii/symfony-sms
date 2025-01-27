<?php

namespace SMS\UserBundle\UserDatatable;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class ProfessorDatatable
 *
 * @package SMS\UserBundle\StudyPlanDatatable
 */
class ProfessorDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->callbacks->set(array(
        'row_callback' => array(
            'template' => 'Pagination/row_callback.js.twig',
            )
        ));


        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => "<'dt-uikit-header'<'uk-grid'<'uk-width-medium-2-3'l><'uk-width-medium-1-3'f>>><'uk-overflow-container'tr><'dt-uikit-footer'<'uk-grid'<'uk-width-medium-3-10'i><'uk-width-medium-7-10'p>>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(1, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' =>  'uikit',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'class' => "uk-table uk-table-striped",
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => true,
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('professor_results'),
            'type' => 'GET',
            'pipeline' => 0
        ));

        $this->columnBuilder
            ->add(null, 'multiselect', array(
                'actions' => array(
                  array(
                      'route' => 'user_bulk_deactivate',
                      'icon' => '&#xE899;',
                      'label' => $this->translator->trans('action.deactivate'),
                      'attributes' => array(
                          'rel' => 'tooltip',
                          'title' => $this->translator->trans('action.delete'),
                          'class' => 'md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light',
                          'role' => 'button'
                      ),
                  ),
                  array(
                      'route' => 'user_bulk_activate',
                      'icon' => '&#xE898;',
                      'label' => $this->translator->trans('action.activate'),
                      'attributes' => array(
                          'rel' => 'tooltip',
                          'title' => $this->translator->trans('action.delete'),
                          'class' => 'md-btn md-btn-primary md-btn-wave-light waves-effect waves-button waves-light',
                          'role' => 'button'
                      ),
                  ),
                )
            ))
            ->add('birthday', 'datetime', array(
                'title' => $this->translator->trans('professor.field.birthday'),
                'date_format' => "DD/MM/YYYY",
                'filter' => array('daterange', array('class' => "md-input")),
            ))
            ->add('firstName', 'column', array(
                'title' => $this->translator->trans('professor.field.firstName'),
                'filter' => array('text', array(

                    'class' => "md-input"
                ))
            ))
            ->add('lastName', 'column', array(
                'title' => $this->translator->trans('professor.field.lastName'),
                'filter' => array('text', array(

                    'class' => "md-input"
                ))
            ))
            ->add('email', 'column', array(
                'title' => $this->translator->trans('user.field.email'),
                'filter' => array('text', array(

                    'class' => "md-input"
                ))
            ))
            ->add('phone', 'column', array(
                'title' => $this->translator->trans('professor.field.phone'),
                'filter' => array('text', array(

                    'class' => "md-input"
                ))
            ))
            ->add('enabled', 'boolean', array(
                'title' => $this->translator->trans('user.field.enabled'),
                'true_icon' => 'uk-icon-check',
                'false_icon' => 'uk-icon-close',
                'filter' => array('select', array(
                    'search_type' => 'eq',
                    'select_options' => array('' => $this->translator->trans('filter.field.all') , true => $this->translator->trans('user.active.true_label') , false => $this->translator->trans('user.active.false_label')) ,
                    'class' => "tablesorter-filter"
                ))
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'professor_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'icon' => '&#xE8F4;',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.show'),
                        ),
                    ),
                    array(
                        'route' => 'professor_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'icon' => '&#xE150;',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                        ),
                    )
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'SMS\UserBundle\Entity\Professor';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'professor_datatable';
    }
}
