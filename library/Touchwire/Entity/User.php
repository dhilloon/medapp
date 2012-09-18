<?php

namespace Touchwire\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/** @Entity(repositoryClass="Touchwire\Entity\Repository\UserRepo")
 * @Table(name="users") 
 * */
class User {
	/**
	 * @Id @Column(type="integer")
	 * @GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/** @Column(type="string", length=50) */
	private $username;

	/** @Column(type="string", length=50) */
	private $password;

	/**
	 * @Column(type="string", length="75", nullable=false)
	 */
	protected $role;

	// 	/**
	// 	 * @Column(type="string", length="75", nullable=true)
	// 	 */
	// 	protected $image;

	/**
	 * @Column(type="string", length="10", nullable=false)
	 */
	protected $active;

	/**
	 * @Column(type="datetime")
	 */
	protected $lastLogin;

	/**
	 * @Column(type="datetime")
	 */
	protected $createdAt;

	/**
	 * @Column(type="datetime")
	 */
	protected $updatedAt;

	// 	//relatioships
		/**
		 *
		 * @param \Doctrine\Common\Collections\ArrayCollection $property
		 * @OneToMany(targetEntity="UserData", mappedBy="user", cascade={"persist", "remove"})
		 */
		protected $userdata;

	// 	/**
	// 	 *
	// 	 * @param \Doctrine\Common\Collections\ArrayCollection $property
	// 	 * @OneToMany(targetEntity="Contact", mappedBy="user", cascade={"persist", "remove"})
	// 	 */
	// 	protected $contact;

	// 	/**
	// 	 *
	// 	 * @param \Doctrine\Common\Collections\ArrayCollection $property
	// 	 * @OneToMany(targetEntity="History", mappedBy="user", cascade={"persist", "remove"})
	// 	 */
	// 	protected $history;

	// 	/**
	// 	 *
	// 	 * @param \Doctrine\Common\Collections\ArrayCollection $property
	// 	 * @OneToMany(targetEntity="Vital", mappedBy="user", cascade={"persist", "remove"})
	// 	 */
	// 	protected $vitals;

	// 	/**
	// 	 *
	// 	 * @param \Doctrine\Common\Collections\ArrayCollection $property
	// 	 * @OneToMany(targetEntity="Encounter", mappedBy="user", cascade={"persist", "remove"})
	// 	 */
	// 	protected $encounter;

	// 	/**
	// 	 *
	// 	 * @param \Doctrine\Common\Collections\ArrayCollection $property
	// 	 * @OneToMany(targetEntity="Prescription", mappedBy="user", cascade={"persist", "remove"})
	// 	 */
	// 	protected $prescription;

	// 	/**
	// 	 *
	// 	 * @param \Doctrine\Common\Collections\ArrayCollection $property
	// 	 * @OneToMany(targetEntity="Admission", mappedBy="user", cascade={"persist", "remove"})
	// 	 */
	// 	protected $admission;

	public function __construct() {
		$this->createdAt = $this->updatedAt = $this->lastLogin = new \DateTime(
				'now');
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}

	public function getPassword() {
		return $this->password;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function getRole() {
		return $this->role;
	}

	public function setRole($role) {
		$this->role = $role;
	}

	public function getActive() {
		return $this->active;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function getLastLogin() {
		return $this->lastLogin;
	}

	public function setLastLogin($lastLogin) {
		$this->lastLogin = $lastLogin;
	}

	public function getCreatedAt() {
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;
	}

	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	public function setUpdatedAt($updatedAt) {
		$this->updatedAt = $updatedAt;
	}

}
