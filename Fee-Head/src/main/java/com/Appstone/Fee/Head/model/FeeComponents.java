package com.Appstone.Fee.Head.model;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;

@Entity
public class FeeComponents {
	
	@Id
	@GeneratedValue(strategy = GenerationType.IDENTITY)
	private Long id;
	private String description;
	private String periodcity;
	private String fineApplicable;
	private String concessionApplicable;
	private String refundable;
	private String accountHead;
	private String activeStatus;
	private int paymentPriority;
	
	public FeeComponents() {
		super();
	}

	public FeeComponents(Long id, String description, String periodcity, String fineApplicable,
			String concessionApplicable, String refundable, String accountHead, String activeStatus,
			int paymentPriority) {
		super();
		this.id = id;
		this.description = description;
		this.periodcity = periodcity;
		this.fineApplicable = fineApplicable;
		this.concessionApplicable = concessionApplicable;
		this.refundable = refundable;
		this.accountHead = accountHead;
		this.activeStatus = activeStatus;
		this.paymentPriority = paymentPriority;
	}

	public Long getId() {
		return id;
	}

	public void setId(Long id) {
		this.id = id;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public String getPeriodcity() {
		return periodcity;
	}

	public void setPeriodcity(String periodcity) {
		this.periodcity = periodcity;
	}

	public String getFineApplicable() {
		return fineApplicable;
	}

	public void setFineApplicable(String fineApplicable) {
		this.fineApplicable = fineApplicable;
	}

	public String getConcessionApplicable() {
		return concessionApplicable;
	}

	public void setConcessionApplicable(String concessionApplicable) {
		this.concessionApplicable = concessionApplicable;
	}

	public String getRefundable() {
		return refundable;
	}

	public void setRefundable(String refundable) {
		this.refundable = refundable;
	}

	public String getAccountHead() {
		return accountHead;
	}

	public void setAccountHead(String accountHead) {
		this.accountHead = accountHead;
	}

	public String getActiveStatus() {
		return activeStatus;
	}

	public void setActiveStatus(String activeStatus) {
		this.activeStatus = activeStatus;
	}

	public int getPaymentPriority() {
		return paymentPriority;
	}

	public void setPaymentPriority(int paymentPriority) {
		this.paymentPriority = paymentPriority;
	}

	@Override
	public String toString() {
		return "FeeComponents [id=" + id + ", description=" + description + ", periodcity=" + periodcity
				+ ", fineApplicable=" + fineApplicable + ", concessionApplicable=" + concessionApplicable
				+ ", refundable=" + refundable + ", accountHead=" + accountHead + ", activeStatus=" + activeStatus
				+ ", paymentPriority=" + paymentPriority + "]";
	}
	
	

}
