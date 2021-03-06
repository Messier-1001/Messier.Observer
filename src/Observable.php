<?php
/**
 * @author         Messier 1001 <messier.1001+code@gmail.com>
 * @copyright  (c) 2016, Messier 1001
 * @package        Messier\GITweb\Service\Observer
 * @since          2017-03-11
 * @version        0.1.0
 */


declare( strict_types = 1 );


namespace Messier\Observer;


/**
 * Defines all base functionality of an observable object
 */
abstract class Observable implements IObservable
{


   // <editor-fold desc="// – – –   P R O T E C T E D   F I E L D S   – – – – – – – – – – – – – – – – – – – – – –">

   /**
    * All registered observers.
    *
    * @type IObserver[]
    */
   protected $_observers;

   /**
    * Stores if something is changed
    *
    * @type boolean
    */
   protected $_changed;

   // </editor-fold>


   // <editor-fold desc="// – – –   P R O T E C T E D   C O N S T R U C T O R   – – – – – – – – – – – – – – – – –">

   /**
    * Observable constructor.
    */
   protected function __construct()
   {

      $this->_observers = [];
      $this->_changed   = false;

   }

   // </editor-fold>


   // <editor-fold desc="// – – –   P U B L I C   M E T H O D S   – – – – – – – – – – – – – – – – – – – – – – – –">

   /**
    * Subscribe a new observer to this observable implementation.
    *
    * @param  \Messier\Observer\IObserver $observer
    * @return \Messier\Observer\IObservable
    */
   public function subscribe( IObserver $observer ) : IObservable
   {

      if ( ! \in_array( $observer, $this->_observers, true ) )
      {
         $this->_observers[] = $observer;
      }

      return $this;

   }

   /**
    * Deletes the subscription of the defined observer (Observer will not longer be informed about something)
    *
    * If no observer is defined all observers will be removed.
    *
    * @param \Messier\Observer\IObserver|null $observer
    * @return \Messier\Observer\IObservable
    */
   public function unsubscribe( ?IObserver $observer = null ) : IObservable
   {

      for ( $i = 0, $c = \count( $this->_observers ); $i < $c; $i++)
      {
         if ( $observer === $this->_observers[ $i ] )
         {
            unset( $this->_observers[ $i ] );
         }
      }

      $this->_observers = array_values( $this->_observers );

      return $this;

   }

   /**
    * Notify all subscribed observers
    *
    * @param  mixed $extras
    * @return \Messier\Observer\IObservable
    */
   public function notify( $extras = null ) : IObservable
   {

      foreach ( $this->_observers as $ob )
      {
         $ob->onUpdate( $this, $extras );
      }

      return $this;

   }

   /**
    * Gets if something is changed.
    *
    * @return bool
    */
   public function isChanged() : bool
   {

      return $this->_changed;

   }

   /**
    * Resets the changed state to FALSE
    */
   public function clearChangedState()
   {

      $this->_changed = false;

   }

   /**
    * Sets the changed state to TRUE.
    */
   public function setChanged()
   {

      $this->_changed = true;

   }

   /**
    * Returns if one or more observers are subscribed.
    *
    * @return bool
    */
   public function hasObservers() : bool
   {

      return 0 < $this->countObservers();

   }

   /**
    * Gets the amount of registered observers.
    *
    * @return int
    */
   public function countObservers() : int
   {

      return \count( $this->_observers );

   }

   // </editor-fold>


}

