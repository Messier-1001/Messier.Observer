<?php
/**
 * @author         Messier 1001 <messier.1001+code@gmail.com>
 * @copyright  (c) 2016, Messier 1001
 * @package        Messier\Observer
 * @since          2017-03-20
 * @version        0.1.0
 */


declare( strict_types = 1 );


namespace Messier\Observer;


/**
 * Each observable object must implement this interface for interact with its observers.
 *
 * @since v0.1.0
 */
interface IObservable
{


   /**
    * Subscribe a new observer to this observable implementation.
    *
    * @param  \Messier\Observer\IObserver $observer
    * @return \Messier\Observer\IObservable
    */
   public function subscribe( IObserver $observer ) : IObservable;

   /**
    * Deletes the subscription of the defined observer (Observer will not longer be informed about something)
    *
    * If no observer is defined all observers will be removed.
    *
    * @param \Messier\Observer\IObserver|null $observer
    * @return \Messier\Observer\IObservable
    */
   public function unsubscribe( ?IObserver $observer = null ) : IObservable;

   /**
    * Notify all listening observers.
    *
    * @param  mixed $extras
    * @return \Messier\Observer\IObservable
    */
   public function notify( $extras = null ) : IObservable;

   /**
    * Gets if something is changed.
    *
    * @return bool
    */
   public function isChanged() : bool;

   /**
    * Resets the changed state to FALSE
    */
   public function clearChangedState();

   /**
    * Sets the changed state to TRUE.
    */
   public function setChanged();

   /**
    * Returns if one or more observers are subscribed.
    *
    * @return bool
    */
   public function hasObservers() : bool;

   /**
    * Gets the amount of registered observers.
    *
    * @return int
    */
   public function countObservers() : int;


}

